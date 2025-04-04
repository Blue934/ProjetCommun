# -*- coding: utf-8 -*-
#!pip install pycryptodome ,cryptography ,keyring (Colab) ou pip install pycryptodome ,cryptography ,keyring

from Crypto.PublicKey import RSA
from Crypto.Cipher import PKCS1_OAEP
from cryptography.hazmat.primitives.ciphers import Cipher, algorithms, modes
from cryptography.hazmat.primitives import padding
from cryptography.hazmat.backends import default_backend
import os
import time
import keyring

# Définir un service et un utilisateur pour le coffre-fort
SERVICE_NAME = "secure_message_app"
USERNAME = "user"

# Fonction pour générer une paire de clés RSA
def generate_rsa_key_pair():
    try:
        key = RSA.generate(2048)
        private_key = key.export_key()
        public_key = key.publickey().export_key()
        return private_key, public_key
    except Exception as e:
        print(f"Erreur lors de la génération des clés RSA : {e}")
        return None, None

# Fonction pour chiffrer un message avec AES
def encrypt_message_aes(key, plaintext):
    try:
        iv = os.urandom(16) # Vecteur d'initialisation (16 bytes)
        cipher = Cipher(algorithms.AES(key), modes.CBC(iv), backend=default_backend())
        encryptor = cipher.encryptor()

        # Ajouter un padding au texte clair
        padder = padding.PKCS7(algorithms.AES.block_size).padder()
        padded_data = padder.update(plaintext.encode()) + padder.finalize()

        # Chiffrer le texte
        ciphertext = encryptor.update(padded_data) + encryptor.finalize()
        return iv + ciphertext
    except Exception as e:
        print(f"Erreur lors du chiffrement AES : {e}")
        return None

# Fonction pour déchiffrer un message avec AES
def decrypt_message_aes(key, ciphertext):
    try:
        iv = ciphertext[:16] # Extraire l'IV
        cipher = Cipher(algorithms.AES(key), modes.CBC(iv), backend=default_backend())
        decryptor = cipher.decryptor()

        # Déchiffrer le texte
        padded_plaintext = decryptor.update(ciphertext[16:]) + decryptor.finalize()

        # Retirer le padding
        unpadder = padding.PKCS7(algorithms.AES.block_size).unpadder()
        plaintext = unpadder.update(padded_plaintext) + unpadder.finalize()
        return plaintext.decode()
    except Exception as e:
        print(f"Erreur lors du déchiffrement AES : {e}")
        return None

# Fonction pour chiffrer la clé AES avec RSA
def encrypt_key_rsa(public_key, aes_key):
    try:
        recipient_key = RSA.import_key(public_key)
        cipher_rsa = PKCS1_OAEP.new(recipient_key)
        encrypted_key = cipher_rsa.encrypt(aes_key)
        return encrypted_key
    except Exception as e:
        print(f"Erreur lors du chiffrement RSA : {e}")
        return None

# Fonction pour déchiffrer la clé AES avec RSA
def decrypt_key_rsa(private_key, encrypted_key):
    try:
        private_key = RSA.import_key(private_key)
        cipher_rsa = PKCS1_OAEP.new(private_key)
        aes_key = cipher_rsa.decrypt(encrypted_key)
        return aes_key
    except Exception as e:
        print(f"Erreur lors du déchiffrement RSA : {e}")
        return None

# Fonction pour envoyer un message sécurisé
def send_secure_message(public_key, plaintext):
    try:
        # 1. Générer une clé AES
        aes_key = os.urandom(32) # Clé AES 256 bits

        # 2. Chiffrer le message avec AES
        encrypted_message = encrypt_message_aes(aes_key, plaintext)
        if not encrypted_message:
            return None, None

        # 3. Chiffrer la clé AES avec RSA
        encrypted_key = encrypt_key_rsa(public_key, aes_key)
        if not encrypted_key:
            return None, None

        return encrypted_key, encrypted_message
    except Exception as e:
        print(f"Erreur lors de l'envoi du message sécurisé : {e}")
        return None, None

# Fonction pour recevoir et déchiffrer un message sécurisé
def receive_secure_message(private_key, encrypted_key, encrypted_message):
    try:
        # 1. Déchiffrer la clé AES avec RSA
        aes_key = decrypt_key_rsa(private_key, encrypted_key)
        if not aes_key:
            return None

        # 2. Déchiffrer le message avec AES
        decrypted_message = decrypt_message_aes(aes_key, encrypted_message)
        return decrypted_message
    except Exception as e:
        print(f"Erreur lors de la réception du message sécurisé : {e}")
        return None

# Fonction pour supprimer les données sensibles
def delete_sensitive_data():
    global encrypted_key, encrypted_message
    encrypted_key = None
    encrypted_message = None
    print("Les données sensibles ont été supprimées en raison d'une tentative de mot de passe incorrect.")

# Fonction pour vérifier le mot de passe
def verify_password(password, correct_password):
    return password == correct_password

# Fonction principale
def main():
    global encrypted_key, encrypted_message

    # Définir un mot de passe et le stocker dans le coffre-fort
    password = input("Définissez un mot de passe : ")
    keyring.set_password(SERVICE_NAME, USERNAME, password)
    print("Mot de passe stocké en toute sécurité.")

    # Générer les paires de clés RSA
    private_key, public_key = generate_rsa_key_pair()
    if not private_key or not public_key:
        print("Erreur : Impossible de générer les clés RSA.")
        return

    print("Voici la private key:\n", private_key.decode())

    # Envoyer un message sécurisé
    message = input("Message secret sécurisé avec cryptage hybride à tester : ")
    encrypted_key, encrypted_message = send_secure_message(public_key, message)
    if not encrypted_key or not encrypted_message:
        print("Erreur : Impossible de chiffrer le message.")
        return

    print(f"Message chiffré : {encrypted_message}")

    # Récupérer le mot de passe depuis le coffre-fort
    correct_password = keyring.get_password(SERVICE_NAME, USERNAME)
    if not correct_password:
        print("Erreur : Aucun mot de passe trouvé.")
        return

    # Demander le mot de passe à l'utilisateur
    tentatives = 5
    attempt_time = 240 # Temps initial d'attente en secondes

    while tentatives > 0:
        user_password = input("Entrez le mot de passe : ")
        if verify_password(user_password, correct_password):
            # Si le mot de passe est correct, déchiffrer le message
            decrypted_message = receive_secure_message(private_key, encrypted_key, encrypted_message)
            if decrypted_message:
                print(f"Message déchiffré : {decrypted_message}")
            else:
                print("Erreur : Impossible de déchiffrer le message.")
            break
        else:
            tentatives -= 1
            if tentatives == 0:
                delete_sensitive_data()
                keyring.delete_password(SERVICE_NAME, USERNAME) # Supprimer le mot de passe du coffre-fort
                print("Mot de passe supprimé du coffre-fort.")
                break
            print(f"Mot de passe incorrect. Veuillez réessayer dans {attempt_time // 60} minutes.")
            print(f"Il vous reste {tentatives} tentatives avant que les données soient supprimées.")
            time.sleep(attempt_time)
            attempt_time *= 8 # Multiplier le temps d'attente par 8



#Intepretation
print("Voulez vous communiquer de manirere securisé ?")
reponse = input("Oui/Non:\n")
if reponse.lower() == "oui":
    main()
    
else:
    print("Vous avez refusé la sécurisation des échanges")







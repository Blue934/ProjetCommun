<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* home/index.html.twig */
class __TwigTemplate_fb85cab1b920d98e3f58c7008823d3af extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "home/index.html.twig"));

        // line 1
        yield "<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 6, $this->source); })()), "html", null, true);
        yield "</title>
    <style>
    /* Styles globaux */
    body {
        background-color: #121212;
        color: #ffffff;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    h1 {
        text-align: center;
        margin-top: 20px;
    }
    nav {
            display: flex;
            justify-content: center;
            background-color: #444;
            width: 100%;
            padding: 0%;
            font-size: 85%;  
    }
    nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
    }
    nav a:hover {
            background-color: #555;
    }
    .image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .image-item {
        border-radius: 10px;
        background-color: #333333;
        background-image: 
        color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .image-item:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
    .image-item img {
        width: 100%; /* Ajuste la largeur de l'image à celle du conteneur */
        height: 150px; /* Définit une hauteur fixe pour uniformiser toutes les images */
        object-fit: cover; /* Recadre l'image pour qu'elle remplisse bien le conteneur */
        display: block;
    }
    .image-info {
        padding: 10px;
        font-size: 14px;
    }

    /* Bouton et formulaires */
    form {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: #333333;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    form input, form button {
        width: calc(100% - 20px);
        margin: 10px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
    }
    form input {
        background-color: #444;
        color: #fff;
    }
    form button {
        background-color: #007BFF;
        color: #ffffff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    form button:hover {
        background-color: #0056b3;
    }
    .no-images {
        text-align: center;
        font-size: 1.2rem;
        color: #888;
    }
</style>
</head>
<body>
    <h1>";
        // line 109
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((isset($context["title"]) || array_key_exists("title", $context) ? $context["title"] : (function () { throw new RuntimeError('Variable "title" does not exist.', 109, $this->source); })()), "html", null, true);
        yield "</h1>
    <!-- présent uniquement pour garentir de l'effet visuel et opérationnel de la bar de naviguation -->
    <nav>
        <a href=\"/\">Accueil</a>
        <a href=\"/login\">Connexion</a>
        <a href=\"/register\">Inscription</a>
        <a href=\"/\">Nous Contacter</a>
    </nav>


    <!-- Formulaire de Connexion -->
    <form id=\"loginForm\">
        <input type=\"text\" name=\"username\" placeholder=\"Nom d'utilisateur\" required />
        <input type=\"password\" name=\"password\" placeholder=\"Mot de passe\" required />
        <button type=\"submit\">Connexion</button>
    </form>

    <!-- Déconnexion -->
    <button id=\"logoutButton\" style=\"display: block; margin: 20px auto;\">Déconnexion</button>

    <!-- Formulaire d'Inscription -->
    <form id=\"registerForm\">
        <input type=\"text\" name=\"username\" placeholder=\"Nom d'utilisateur\" required />
        <input type=\"email\" name=\"email\" placeholder=\"Email\" required />
        <input type=\"password\" name=\"password\" placeholder=\"Mot de passe\" required />
        <button type=\"submit\">S'inscrire</button>
    </form>

    <!-- Formulaire d'Ajout de Photos -->
    <form id=\"addPhotoForm\">
        <input type=\"file\" name=\"photo\" required />
        <button type=\"submit\">Ajouter la photo</button>
    </form>

    <!-- Grille d'Images -->
    <div class=\"image-grid\">
        ";
        // line 145
        if ((array_key_exists("images", $context) && (Twig\Extension\CoreExtension::length($this->env->getCharset(), (isset($context["images"]) || array_key_exists("images", $context) ? $context["images"] : (function () { throw new RuntimeError('Variable "images" does not exist.', 145, $this->source); })())) > 0))) {
            // line 146
            yield "            ";
            $context['_parent'] = $context;
            $context['_seq'] = CoreExtension::ensureTraversable((isset($context["images"]) || array_key_exists("images", $context) ? $context["images"] : (function () { throw new RuntimeError('Variable "images" does not exist.', 146, $this->source); })()));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 147
                yield "                <div class=\"image-item\">
                    <img src=\"";
                // line 148
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\AssetExtension']->getAssetUrl(("uploads/" . CoreExtension::getAttribute($this->env, $this->source, $context["image"], "path", [], "any", false, false, false, 148))), "html", null, true);
                yield "\" alt=\"Image de ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["image"], "user", [], "any", false, false, false, 148), "html", null, true);
                yield "\">
                    <div class=\"image-info\">
                        <p><strong>";
                // line 150
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["image"], "user", [], "any", false, false, false, 150), "html", null, true);
                yield "</strong> - ";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["image"], "city", [], "any", false, false, false, 150), "html", null, true);
                yield " - ❤️";
                yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["image"], "likes", [], "any", false, false, false, 150), "html", null, true);
                yield " </p>
                    </div>
                </div>
            ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_key'], $context['image'], $context['_parent']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 154
            yield "        ";
        } else {
            // line 155
            yield "            <p class=\"no-images\">Aucune image disponible pour le moment.</p>
        ";
        }
        // line 157
        yield "    </div>

<script>
    function Redirection(imageUrl) {
    console.log(`Redirection vers l'URL : \${imageUrl}`);
    window.location.href = imageUrl; // Redirige vers l'URL de l'image
    }

    // Clique sur l'image 
    document.querySelectorAll('.image-item img').forEach(image => {
    image.addEventListener('click', () => {
        //alert(`Tu as cliqué sur l'image : \${image.src}`);//
        Redirection(image.src)
        });
    });
        // Fonction générique pour gérer les erreurs
    function handleFetchError(error) {
        console.error('Une erreur est survenue :', error);
        alert('Une erreur est survenue, veuillez réessayer.');
    }

    // Fonction générique pour envoyer des données via Fetch
    async function sendRequest(url, method, body = null, headers = {}) {
        try {
            const options = { method };
            if (body) options.body = body;
            if (Object.keys(headers).length > 0) options.headers = headers;

            const response = await fetch(url, options);
            if (!response.ok) {
                throw new Error(`Erreur HTTP \${response.status}`);
            }
            return await response.json();
        } catch (error) {
            handleFetchError(error);
            return null;
        }
    }

    // Ajout de photo
    document.getElementById('addPhotoForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const data = await sendRequest('/add-photo', 'POST', formData);
        if (data) alert(data.message);
    });

    // Inscription
    document.getElementById('registerForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const jsonBody = JSON.stringify(Object.fromEntries(formData));
        const data = await sendRequest('/register', 'POST', jsonBody, { 'Content-Type': 'application/json' });
        if (data) alert(data.message);
    });

    // Connexion
    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const jsonBody = JSON.stringify(Object.fromEntries(formData));
        const data = await sendRequest('/login', 'POST', jsonBody, { 'Content-Type': 'application/json' });
        if (data) alert(data.message);
    });

    // Déconnexion
    document.getElementById('logoutButton').addEventListener('click', async () => {
        const data = await sendRequest('/logout', 'POST');
        if (data) alert(data.message);
    });
</script>
</body>
</html>";
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "home/index.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  238 => 157,  234 => 155,  231 => 154,  217 => 150,  210 => 148,  207 => 147,  202 => 146,  200 => 145,  161 => 109,  55 => 6,  48 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html lang=\"fr\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>{{ title }}</title>
    <style>
    /* Styles globaux */
    body {
        background-color: #121212;
        color: #ffffff;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    h1 {
        text-align: center;
        margin-top: 20px;
    }
    nav {
            display: flex;
            justify-content: center;
            background-color: #444;
            width: 100%;
            padding: 0%;
            font-size: 85%;  
    }
    nav a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
    }
    nav a:hover {
            background-color: #555;
    }
    .image-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 10px;
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }
    .image-item {
        border-radius: 10px;
        background-color: #333333;
        background-image: 
        color: #ffffff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .image-item:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }
    .image-item img {
        width: 100%; /* Ajuste la largeur de l'image à celle du conteneur */
        height: 150px; /* Définit une hauteur fixe pour uniformiser toutes les images */
        object-fit: cover; /* Recadre l'image pour qu'elle remplisse bien le conteneur */
        display: block;
    }
    .image-info {
        padding: 10px;
        font-size: 14px;
    }

    /* Bouton et formulaires */
    form {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background-color: #333333;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    form input, form button {
        width: calc(100% - 20px);
        margin: 10px;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
    }
    form input {
        background-color: #444;
        color: #fff;
    }
    form button {
        background-color: #007BFF;
        color: #ffffff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    form button:hover {
        background-color: #0056b3;
    }
    .no-images {
        text-align: center;
        font-size: 1.2rem;
        color: #888;
    }
</style>
</head>
<body>
    <h1>{{ title }}</h1>
    <!-- présent uniquement pour garentir de l'effet visuel et opérationnel de la bar de naviguation -->
    <nav>
        <a href=\"/\">Accueil</a>
        <a href=\"/login\">Connexion</a>
        <a href=\"/register\">Inscription</a>
        <a href=\"/\">Nous Contacter</a>
    </nav>


    <!-- Formulaire de Connexion -->
    <form id=\"loginForm\">
        <input type=\"text\" name=\"username\" placeholder=\"Nom d'utilisateur\" required />
        <input type=\"password\" name=\"password\" placeholder=\"Mot de passe\" required />
        <button type=\"submit\">Connexion</button>
    </form>

    <!-- Déconnexion -->
    <button id=\"logoutButton\" style=\"display: block; margin: 20px auto;\">Déconnexion</button>

    <!-- Formulaire d'Inscription -->
    <form id=\"registerForm\">
        <input type=\"text\" name=\"username\" placeholder=\"Nom d'utilisateur\" required />
        <input type=\"email\" name=\"email\" placeholder=\"Email\" required />
        <input type=\"password\" name=\"password\" placeholder=\"Mot de passe\" required />
        <button type=\"submit\">S'inscrire</button>
    </form>

    <!-- Formulaire d'Ajout de Photos -->
    <form id=\"addPhotoForm\">
        <input type=\"file\" name=\"photo\" required />
        <button type=\"submit\">Ajouter la photo</button>
    </form>

    <!-- Grille d'Images -->
    <div class=\"image-grid\">
        {% if images is defined and images|length > 0 %}
            {% for image in images %}
                <div class=\"image-item\">
                    <img src=\"{{ asset('uploads/' ~ image.path) }}\" alt=\"Image de {{ image.user }}\">
                    <div class=\"image-info\">
                        <p><strong>{{ image.user }}</strong> - {{ image.city }} - ❤️{{ image.likes}} </p>
                    </div>
                </div>
            {% endfor %}
        {% else %}
            <p class=\"no-images\">Aucune image disponible pour le moment.</p>
        {% endif %}
    </div>

<script>
    function Redirection(imageUrl) {
    console.log(`Redirection vers l'URL : \${imageUrl}`);
    window.location.href = imageUrl; // Redirige vers l'URL de l'image
    }

    // Clique sur l'image 
    document.querySelectorAll('.image-item img').forEach(image => {
    image.addEventListener('click', () => {
        //alert(`Tu as cliqué sur l'image : \${image.src}`);//
        Redirection(image.src)
        });
    });
        // Fonction générique pour gérer les erreurs
    function handleFetchError(error) {
        console.error('Une erreur est survenue :', error);
        alert('Une erreur est survenue, veuillez réessayer.');
    }

    // Fonction générique pour envoyer des données via Fetch
    async function sendRequest(url, method, body = null, headers = {}) {
        try {
            const options = { method };
            if (body) options.body = body;
            if (Object.keys(headers).length > 0) options.headers = headers;

            const response = await fetch(url, options);
            if (!response.ok) {
                throw new Error(`Erreur HTTP \${response.status}`);
            }
            return await response.json();
        } catch (error) {
            handleFetchError(error);
            return null;
        }
    }

    // Ajout de photo
    document.getElementById('addPhotoForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const data = await sendRequest('/add-photo', 'POST', formData);
        if (data) alert(data.message);
    });

    // Inscription
    document.getElementById('registerForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const jsonBody = JSON.stringify(Object.fromEntries(formData));
        const data = await sendRequest('/register', 'POST', jsonBody, { 'Content-Type': 'application/json' });
        if (data) alert(data.message);
    });

    // Connexion
    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        const jsonBody = JSON.stringify(Object.fromEntries(formData));
        const data = await sendRequest('/login', 'POST', jsonBody, { 'Content-Type': 'application/json' });
        if (data) alert(data.message);
    });

    // Déconnexion
    document.getElementById('logoutButton').addEventListener('click', async () => {
        const data = await sendRequest('/logout', 'POST');
        if (data) alert(data.message);
    });
</script>
</body>
</html>", "home/index.html.twig", "C:\\Users\\oreni\\Desktop\\nom_du_projet\\templates\\home\\index.html.twig");
    }
}

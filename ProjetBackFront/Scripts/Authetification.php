namespace App\Security;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserAuthHelper
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function encodePassword(UserInterface $user, string $plainPassword): string
    {
        return $this->passwordEncoder->encodePassword($user, $plainPassword);
    }
}


//Authentification des utilisateurs//

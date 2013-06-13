<?php defined('SYSPATH') OR die('No Direct Script Access');

return array(
    'first_name' => array(
        'not_empty' => 'Het opgeven van je voornaam is verplicht.',
        'min_length' => 'De voornaam mag niet korter zijn dan :param2 karakters.',
        'max_length' => 'De voornaam mag niet langer zijn dan :param2 karakters.',
    ),
    'last_name' => array(
        'not_empty' => 'Het opgeven van je achternaam is verplicht.',
        'min_length' => 'De voornaam mag niet korter zijn dan :param2 karakters.',
        'max_length' => 'De voornaam mag niet langer zijn dan :param2 karakters.',
    ),
    'username' => array(
        'not_empty' => 'Je bent verplicht een gebruikersnaam in te stellen.',
        'min_length' => 'De gebruikersnaam mag niet korter zijn dan :param2 karakters.',
        'max_length' => 'De gebruikersnaam mag niet langer zijn dan :param2 karakters.',
        'check_username' => 'Deze gebruikersnaam is al bezet.',
    ),
    'password' => array(
        'not_empty' => 'Je bent verplicht een wachtwoord in te stellen.',
    ),
);
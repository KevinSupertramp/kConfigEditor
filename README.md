kConfigEditor
=============

Une librairie pour l'�dition des fichiers de configuration pour le framework PHP kowFramework.


<h2>Utilisation</h2>

1. Placer la librairie dans le dossier "librairies" de kowFramework.

2. Charger la librairie dans le contr�leur, passer en param�tre le chemin vers le fichier et ouvrir le fichier :
```php
	$configEditor = $this->load()->library('kConfigEditor/ConfigEditor', 'test.php');
	if (!$configEditor->open())
		echo 'Erreur lors de l'ouverture du fichier de configuration. Si vous d�cidez de sauvegarder le fichier celui-ci sera cr��.';
```

3. Modifier et/ou ajouter des param�tres du fichier de configurations :
```php
	// Si le param�tre existe, il est modifi�.
    $configEditor->set('default_controller', 'page');
	// S'il n'existe pas, il est ajout� � la fin du fichier.
	$configEditor->set('plugins', array('MyPlugins1', 'MyPlugins2'));
```

4. Sauvegarder les changements dans le fichier :
```php
	// Si le fichier n'existe pas, il est cr�� automatiquement.
    $configEditor->save();
```

5. R�sultat (fichier test.php) :
```php
	// Avant
	$config['default_controller'] = 'news';
	
	// Apr�s
	$config['default_controller'] = 'page';

	$config['plugins'] = array('MyPlugins1', 'MyPlugins2');
```

6. Les constantes sont support�es mais il faut les d�clarer en tant que cha�ne de caract�res (string) :
```php
	// Exemple
	$configEditor->set('database', array(
		'PDO::MYSQL_ATTR_INIT_COMMAND' => 'SET NAMES utf8',
		'PDO::ATTR_ERRMODE',
		'PDO::ERRMODE_WARNING',
	));
	
	// R�sultat dans le fichier de configuration
	$config['database'] = array(
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		PDO::ATTR_ERRMODE,
		PDO::ERRMODE_WARNING,
	);
```

6. Cas concret, �dition/ajout de la configuration d'une base de donn�es :
```php
	// A noter les constantes PDO d�finie comme cha�ne de caract�res (string).
	$configEditor->set('database', array(
		'kowcms' => array(
			'host' 		=> 'localhost',
			'port'		=> 3306,
			'username'	=> 'root',
			'password'	=> '',
			'options'	=> array(
				'PDO::MYSQL_ATTR_INIT_COMMAND' => 'SET NAMES utf8',
				'PDO::ATTR_ERRMODE', 'PDO::ERRMODE_WARNING'
			)
		)
	));
	
	// R�sultat dans le fichier de configuration
	$config['database'] = array(
		'kowcms' => array(
			'host' => 'localhost',
			'port' => 3306,
			'username' => 'root',
			'password' => '',
			'options' => array(
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
				PDO::ATTR_ERRMODE,
				PDO::ERRMODE_WARNING,
			)
		)
	);
```

<h2>Auteur</h2>
Kevin Ryser (27.03.2013). D�velopp� pour kowFramework.

N'h�sitez pas � me contacter ou � "forker" le d�p�t en cas de questions, suggestions, etc.


<h2>Copyright et licence</h2>
<pre>
New BSD License
---------------

Copyright (C) 2013 Kevin Ryser (http://www.koweb.ch) All rights reserved.

Redistribution and use in source and binary forms, with or without modification,
are permitted provided that the following conditions are met:
* Redistributions of source code must retain the above copyright notice, this
  list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice, this
  list of conditions and the following disclaimer in the documentation and/or
  other materials provided with the distribution.
* Neither the name of �Koweb� nor the names of its contributors may be used to
  endorse or promote products derived from this software without specific prior
  written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS �AS IS� AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
(INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
(INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
</pre>
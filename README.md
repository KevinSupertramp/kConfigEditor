kConfigEditor
=============

Une librairie pour l'édition des fichiers de configuration pour le framework PHP kowFramework.


<h2>Utilisation</h2>

1. Placer la librairie dans le dossier "librairies" de kowFramework.

2. Charger la librairie dans le contrôleur et passer en paramètre le chemin vers le fichier :
```php
	$configEditor = $this->load()->library('kConfigEditor/ConfigEditor', 'test.php');
```

3. Modifier et/ou ajouter des paramètres du fichier de configurations :
```php
	// Si le paramètre existe, il est modifié.
    $configEditor->set('default_controller', 'page');
	// S'il n'existe pas, il est ajouté à la fin du fichier.
	$configEditor->set('plugins', array('MyPlugins1', 'MyPlugins2');
```

4. Sauvegarder les changements dans le fichier :
```php
	// Si le fichier n'existe pas, il est créé automatiquement.
    $configEditor->save();
```


<h2>Auteur</h2>
Kevin Ryser (27.03.2013). Développé pour kowFramework.

N'hésitez pas à me contacter ou à "forker" le dépôt en cas de questions, suggestions, etc.


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
* Neither the name of “Koweb” nor the names of its contributors may be used to
  endorse or promote products derived from this software without specific prior
  written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS “AS IS” AND
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
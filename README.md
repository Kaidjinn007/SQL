#Projet Blog en MVC
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/Kaidjinn007/MVC.git
git push -u origin main

Réaliser un blog en respectant le pattern Model-View-Controller (MVC) dans le cadre de la formation DWWM de Simplon.

Ci-dessous l'architecture de dossier souhaitée:

📁 monSuperBlog
	- 📁controller
		- 📄 errorController.php
		- 📄 postController.php
		- 📄 usercontroller.php
	- 📁model
		- postRepository
	- 📁public
		- 📁css
		- 📁img
		- 📁js
		- 📄 index.php
	- 📁view
		- 📁error
			- 📄error404.php
		- 📁post
			- 📄home.php
			- 📄 post.php
		- 📁shared
			- 📄 _nav.php
		- 📁user
			- 📄 connectionForm.php
		- 📄 base.php

ci-dessous les wireframe et la base de données :
![Alt text](views&bdd.jpg?raw=true "Title") 
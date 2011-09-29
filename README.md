# Limovico

* Author:    Onat Yigit Mercan - onatmercan [at] gmail [dot] com
* Date:      September, 2011
* Version:   1.0.0
* GitHub:    <https://github.com/onatm/limovico>

# What is Limovico

Limovico is a lightweight hierarchical-model-view-controller framework to build websites using PHP. It comes with several core and library classes to handle main functions of a web site.

## Features

* Modular model-view-controller structure.
* Contollers can call models and views of other modules.
* Lightweight baby!

## Server Requirements

* PHP version 5.1.0 or newer.

## Installation 

Place Limovico to any directory in your webserver.

## Configuration

* There is no configuration needed to run Limovico.
* To use a database, edit `/application/configurations/database.php`.
* To change default controller and method, edit `/application/configurations/routes.php`.

## Example

Here a simple example of the usage of Limovico.

* Controller example:

	<?php
		class Home extends Moco {
			function show()
			{
				$data['welcome'] = 'Welcome to Limovico';
				$this->wrapper->model('home','home_model');
				$this->wrapper->home_model->connect_db();
				$data['dbs'] = $this->wrapper->home_model->get_dbs();
				$this->wrapper->view('home','home_view',$data);
			}
		}

		
* Model example:

	<?php
		class home_model extends Moco {
			var $db;
			function __construct($wrapper)
			{
				parent::__construct($wrapper);
				$this->wrapper->library('Database');
			}
			function connect_db()
			{
				$this->db = $this->wrapper->database->connect();
			}
			function get_dbs()
			{
				$this->db->query('Show databases');
				$data = $this->db->result();
				return $data;
			}
		}

* View example:

	<!DOCTYPE html>
		<html lang="en">
			<head>
			<meta charset="utf-8" />
			<title></title>
		</head>
		<body>
			<p><?php echo $welcome; ?></p>
			<?php foreach ($dbs as $db): ?>
			<p><?php echo $db->Database; ?></p>
			<?php endforeach; ?>
		</body>
	</html>


TODO
----

1. Cache library should be added.

<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="help find where stock is in the tops">
		<!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
		
		<link rel="shortcut icon" href="/image/flag.ico">
		
		<link rel="stylesheet" href="/css/pure/pure-min.css">
		<link rel="stylesheet" href="/css/style.css">
		
		<script type="text/javascript" src="/js/scripts.js"></script>
		<title></title>
	</head>
	
	<body onload="slider(document.getElementById('acontroller'), document.getElementById('sidebar'));">
		<div class="container">
			<!-- login popup window -->
			<div class="login-window" onclick="this.style.display = 'none';">
				<div class="login-form" onclick="event.stopPropagation();">
					<form id="loginform" method="post" class="pure-form pure-form-stacked">
						<div class="pure-control-group">
							<h2 style="text-align: center;">Log In</h2>
						</div>
						<div class="pure-control-group">
				            <label for="username">Username</label>
				            <input name="username" id="username" type="text" placeholder="">
				        </div>
				        <div class="pure-control-group">
				            <label for="password">Password</label>
				            <input name="password" id="password" type="password" placeholder="">
				        </div>
				        <input name="query" style="display: none;" type="text" value="login"></input>
				        <div class="pure-controls">
				            <button form="loginform" type="submit" class="pure-button pure-button-primary">Log In</button>
				        </div>
					</form>
				</div>
			</div>
			
			<!-- contains the name of the site and the form to query the database -->
			<div id="sidebar" class="aside">
				
				<div class="pure-menu pure-menu-horizontal">
				    <ul class="pure-menu-list">
				        <li class="pure-menu-item"><button onclick="setTab('tab-1');" class="pure-button">Search</button></li>
				        <li class="pure-menu-item"><button onclick="setTab('tab-2');" class="pure-button">Add Item</button></li>
				    </ul>
				</div>
				
				<div class="form-container form-container-first" id="tab-1">
					<h1>Search</h1>
					<form id="searchform" method="post" class="pure-form pure-form-stacked">
				    <fieldset>
				    	
				    	<div class="pure-control-group">
				            <label for="name">Name</label>
				            <input name="name" id="name" type="text" placeholder="">
				        </div>
				    	
				        <div class="pure-control-group">
				            <label for="brand">Brand</label>
				            <select name="brand" id="brand" type="combo">
				            	<option></option>
				            	<?php 
				            		if(isset($brands)) {
				            			foreach($brands as $brand) {
				            				echo('<option>' . $brand->name . '</option>');
				            			}
				            		}
				            	?>
				            </select>
				        </div>
				
				        <div class="pure-control-group">
				            <label for="Type">Type</label>
				            <select name="type" id="Type" type="combo">
				            	<option></option>
				            	<?php 
				            		if(isset($types)) {
				            			foreach($types as $type) {
				            				echo('<option>' . $type->name . '</option>');
				            			}
				            		}
				            	?>
				            </select>
				        </div>
				        
				        <div class="pure-control-group">
				            <label for="target">Target</label>
				            <select name="target" id="target" type="combo">
				            	<option></option>
				            	<option>m</option>
				            	<option>w</option>
				            	<option>pb</option>
				            	<option>pg</option>
				            	<option>cb</option>
				            	<option>cg</option>
				            </select>
				            
				        </div>
				        
				        <div class="pure-control-group">
				            <label for="condition">Condition</label>
				            <select name="condition" id="condition" type="combo">
				            	<option></option>
				            	<option>mixed</option>
				            	<option>loose</option>
				            	<option>new</option>
				            </select>
				        </div>
				
				        <div class="pure-control-group">
				            <label for="size">Size</label>
				            <input name="size" id="size" type="text" placeholder="14">
				        </div>
				        
				        <div class="pure-control-group">
				            <label for="colour">Colour</label>
				            <input name="colour" id="colour" type="text" placeholder="grn">
				        </div>
				        
				        <div class="pure-control-group">
				            <label for="location">Location</label>
				            <input name="location" id="location" type="text" placeholder="e.g. '9L3T = left of isle 9, bay 3 in the tops'">
				        </div>
				        
				        <input name="query" style="display: none;" type="text" value="search"></input>
				
				        <div class="pure-controls">
				            <button form="searchform" type="submit" class="pure-button pure-button-primary">Search</button>
				        </div>
				    </fieldset>
				</form>
				</div>
				
				<div class="form-container" id="tab-2">
					<h1>Add</h1>
					<form id="addform" method="post" class="pure-form pure-form-stacked">
				    <fieldset>
				    	
				    	<div class="pure-control-group">
				            <label for="name">Name</label>
				            <input name="name" id="name" type="text" placeholder="">
				        </div>
				    	
				        <div class="pure-control-group">
				            <label for="brand">Brand</label>
				            <select name="brand" id="brand" type="combo">
				            	<option></option>
				            	<?php 
				            		if(isset($brands)) {
				            			foreach($brands as $brand) {
				            				echo('<option>' . $brand->name . '</option>');
				            			}
				            		}
				            	?>
				            </select>
				        </div>
				
				        <div class="pure-control-group">
				            <label for="Type">Type</label>
				            <select name="type" id="Type" type="combo">
				            	<option></option>
				            	<?php 
				            		if(isset($types)) {
				            			foreach($types as $type) {
				            				echo('<option>' . $type->name . '</option>');
				            			}
				            		}
				            	?>
				            </select>
				        </div>
				        
				        <div class="pure-control-group">
				            <label for="target">Target</label>
				            <select name="target" id="target" type="combo">
				            	<option>m</option>
				            	<option>w</option>
				            	<option>pb</option>
				            	<option>pg</option>
				            	<option>cb</option>
				            	<option>cg</option>
				            </select>
				        </div>
				        
				        <div class="pure-control-group">
				            <label for="condition">Condition</label>
				            <select name="condition" id="condition" type="combo">
				            	<option>mixed</option>
				            	<option>loose</option>
				            	<option>new</option>
				            </select>
				        </div>
				
				        <div class="pure-control-group">
				            <label for="size">Size</label>
				            <input name="size" id="size" type="text" placeholder="14">
				        </div>
				        
				        <div class="pure-control-group">
				            <label for="colour">Colour</label>
				            <input name="colour" id="colour" type="text" placeholder="grn">
				        </div>
				        
				        <div class="pure-control-group">
				            <label for="location">Location</label>
				            <input name="location" id="location" type="text" placeholder="e.g. '9L3T = left of isle 9, bay 3 in the tops'">
				        </div>
				        
				        <input name="query" style="display: none;" type="text" value="add"></input>
				
				        <div class="pure-controls">
				            <button form="addform" type="submit" class="pure-button pure-button-primary">Add</button>
				        </div>
				    </fieldset>
				</form>
				</div>
				
			</div>
			<div id="acontroller" class="aside-controller">
				<button class="pure-button" onclick="slider(document.getElementById('acontroller'), document.getElementById('sidebar'));"></button>
			</div>
			
			<!-- headder containing link to login/logout -->
			<div class="header">
				<ul>
					<?php 
						if(!isset($username)) {
							echo("<li><button id='login-button' class='pure-button' onclick='showLoginScreen();'>Login</button></li>");
						}
						else {
							echo("<li id='logedin-name'>$username</li><li><button id='logout-button' class='pure-button' onclick='showLogoutScreen();'>Logout</button></li>");
						}
					?>
				</ul>
			</div>
			<!-- contains the table of results -->
			<div class="results">
				<table class="pure-table">
				    <thead>
				        <tr>
				            <th>Name</th>
				            <th>Brand</th>
				            <th>Type</th>
				            <th>Target</th>
				            <th>Size</th>
				            <th>Colour</th>
				            <th>Location</th>
				            <th>Condition</th>
				            <th>Delete</th>
				        </tr>
				    </thead>
				    <tbody>
				    <?php 
				    if(isset($message)) {
				    		echo("<th colspan='9'>" . $message . "</th>");
				   	}
				    
				    if(isset($result)) {
				    $odd = true;
				    foreach($result as $row) {
				    	if($odd) {
				    	echo(
				    		"
				    		<tr class='pure-table-odd'>
				            <th>{$row->name}</th>
				            <th>{$row->brand}</th>
				            <th>{$row->type}</th>
				            <th>{$row->target}</th>
				            <th>{$row->size}</th>
				            <th>{$row->colour}</th>
				            <th>{$row->location}</th>
				            <th>{$row->condition}</th>
				            <th><button class='pure-button' type='submit' form='deleteform' onclick='deleteRow($row->id);'>Delete Item</button></th>
				        	</tr>
				    		");
				    	}
				    	else {
				    		echo(
				    			"
					    		<tr>
					            <th>{$row->name}</th>
					            <th>{$row->brand}</th>
					            <th>{$row->type}</th>
					            <th>{$row->target}</th>
					            <th>{$row->size}</th>
					            <th>{$row->colour}</th>
					            <th>{$row->location}</th>
					            <th>{$row->condition}</th>
					            <th><button class='pure-button' type='submit' form='deleteform' onclick='deleteRow($row->id);'>Delete Item</button></th>
					        	</tr>
				    			"
				    			);
				    	}
				    	
				    	$odd = !$odd;
				    	}
				    }
				    ?>
				    </tbody>
				</table>
			</div>
			<!-- contains a contact me page and feedback page -->
			
			
			<form id="deleteform" method="post" style="display: none;">
				<input id="deleteinput" name="id" type="text"></input>
				<input name="query" style="display: none;" type="text" value="delete"></input>
			</form>
		</div>
	</body>
</html>
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
	
	<body onload="slider(document.getElementById('acontroller'), document.getElementById('sidebar')); loadCookies();">
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
				        <li class="pure-menu-item"><button onclick="setTab('tab-1');" class="pure-button">Add/Search</button></li>
				        <li class="pure-menu-item"><button onclick="setTab('tab-2');" class="pure-button">About</button></li>
				    </ul>
				</div>
				
				<div class="form-container form-container-first" id="tab-1">
					<h1>Search/Add</h1>
					<form id="search-add-form" method="post" class="pure-form pure-form-stacked">
				    <fieldset>
				    	
				    	<div class="pure-control-group">
				            <label for="name">Name</label>
				            <input name="name" id="name" type="text" placeholder="" onchange="setCookie('name', this.value);">
				        </div>
				    	
				        <div class="pure-control-group">
				            <label for="brand">Brand</label>
				            <select name="brand" id="brand" type="combo" onchange="setCookie('brand', this.selectedIndex);">
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
				            <select name="type" id="Type" type="combo" onchange="setCookie('type', this.selectedIndex);">
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
				            <select name="target" id="target" type="combo" onchange="setCookie('target', this.selectedIndex);">
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
				            <select name="condition" id="condition" type="combo" onchange="setCookie('condition', this.selectedIndex);">
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
				            <input name="location" id="location" type="text">
				        </div>
				        
				        <input id="add-search-query-field" name="query" style="display: none;" type="text" value="search"></input>
				
				        <div class="pure-controls">
				            <button form="search-add-form" type="submit" class="pure-button pure-button-primary" onclick="setQueryFiled('search');">Search</button>
				            <button form="search-add-form" type="submit" class="pure-button pure-button-primary" onclick="setQueryFiled('add');">Add</button>
				        </div>
				    </fieldset>
				</form>
				</div>
				
				<div class="form-container" id="tab-2">
					<h1>About</h1>
					<p>this site was created as a means to track boxes of stock in the tops of the shoe isles, as boxes do tend to get hard to find being there is no sorting system beyond "Put the box above the bay it is meant to be in, unless there is no room in which case put it anywhere there is room."<br><br>using this application you add a minimum of the name of the item, and its location.<br><br>location codes are as such: 9T3<br>9 = isle number<br>T = top, replace with 'P' for picking shelf<br>3 = bay number, how many bays in is the box located?<br><br>You can find the source code for this project <a href="https://github.com/Gnomorian/StockFinder">here</a>.
					</p>
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
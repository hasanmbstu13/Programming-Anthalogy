<?php 
// Expression engine backend
// http://solutionscenter.local/WRVDy8stCJQ4Pk.php

// Set $debug = 0 for workable all this module
// Another Setting wwwroot/index.php debug=0
// log files system/expressionengine/logs/ in here


// Sometime needs to change the compression condition
// E:\SERVER\apache2\htdocs\solutionscenter-v2\system\codeigniter\system\core\Output.php

// database configuration here
// site_assets/config/config.local.php

// Template file location may be like this
// /site_assets/templates/default_site/communities.group/detail.html


// Working Procedure
// 1. You need to create a field group first
// 2. Then you need to create fields under fieldgroup various fields like custom fields in wordpress
// 3. Then you need to create channel like wordpress post type 
// 	while create channel you need to assign a field group 
// 	for that channel then you add content under channel
// 4. then you need to show those content using template under template group
// like wordpress template


// To add extra field with user registration form or any other form follow as follows
// <textarea id="Field314" name="additional_information" class="field textarea medium" spellcheck="true" rows="10" cols="50" tabindex="37"></textarea>
// Create same field in member fields give the Field Name as like the field name in textarea like additional_information
// Now insert data and rest expressionengine handle by itself

// Naming Convention of Expression Engine with Wordpress 
// field group first as like acf filed group creating for about about_page_extra_fields for example
// create fields under fieldgroup various fields like custom fields in wordpress
// create channel like wordpress post type
// for that channel then you add content under channel
// then you need to show those content using template under template group


// Administrator Account
// Email: mainulmbstu11@gmail.com
// Account: hasanmbstu13
// Password: 12345678

// ExpressionEngine stores all of your information inside Channels
// A Channel is simply a container that can be as simple or as complex as you need it to be, depending on your content

// New member fields are available here
// exp_members
// exp_member_data
// Alla actions are available in database table
// exp_actions
// version number stored in exp_modules

// Expression Engine Query
{exp:query sql="SELECT screen_name FROM exp_members WHERE member_id = '1' "}
        {screen_name}
{/exp:query}
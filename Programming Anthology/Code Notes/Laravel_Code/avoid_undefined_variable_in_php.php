Notice: Undefined variable
Ways to deal with the issue:

    Recommended: Declare your variables, for example when you try to append a string to an undefined variable. Or use isset() / !empty() to check if they are declared before referencing them, as in:

    <?php 
    	//Initializing variable
    	$value = ""; //Initialization value; Examples
    	             //"" When you want to append stuff later
    	             //0  When you want to add numbers later
    	//isset()
    	$value = isset($_POST['value']) ? $_POST['value'] : '';
    	//empty()
    	$value = !empty($_POST['value']) ? $_POST['value'] : '';
     ?>

    Set a custom error handler for E_NOTICE and redirect the messages away from the standard output (maybe to a log file):

    set_error_handler('myHandlerForMinorErrors', E_NOTICE | E_STRICT)

    Disable E_NOTICE from reporting. A quick way to exclude just E_NOTICE is:

    error_reporting( error_reporting() & ~E_NOTICE )

    Suppress the error with the @ operator.

Note: It's strongly recommended to implement just point 1.


Notice: Undefined index
This notice appears when you try to access an undefined index of an array.

Ways to deal with the issue:

    Check if the index exists before you access it. For this you can use isset() or array_key_exists():

<?php 
	//isset()
	$value = isset($array['my_index']) ? $array['my_index'] : '';
	//array_key_exists()
	$value = array_key_exists('my_index', $array) ? $array['my_index'] : '';
 ?>


<?php 
	// recommended solution
	$user_name = $_SESSION['user_name'];
	if (empty($user_name)) $user_name = '';

	// OR 

	// just define at the top of the script index.php
	$user_name = ''; 
	$user_name = $_SESSION['user_name'];

	// OR 

	$user_name = $_SESSION['user_name'];
	if (!isset($user_name)) $user_name = '';
 ?>



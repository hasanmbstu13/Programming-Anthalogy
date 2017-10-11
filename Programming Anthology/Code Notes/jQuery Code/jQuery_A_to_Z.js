// Rememeber that
$(this) //refers to the selected object


// is method
// is takes any of the same selectors we normally pass to the jQuery function, 
// and checks to see if they match the elements it was called on.
// iswill return trueor falsedepending on whether the elements match the selector.
$('#toggleButton').click(function() {
	if ($('#disclaimer').is(':visible')) {
		$('#disclaimer').hide();
	} else {
		$('#disclaimer').show();
	}
});

// Toggling
// the element toggles between visible and hidden.
$('#toggleButton').click(function() {
	$('#disclaimer').toggle();
});

// Adding New Elements
// to add a class to our newly created element, we can simply write
$('<p>A new paragraph!</p>').addClass('new');

// insertAfter()
// insertAfter() insert the element after the selected element
// The insertAfter function adds the new element as a sibling directly after the disclaimer element.
$('<input type="button" value="toggle" id="toggleButton">').insertAfter('#disclaimer');
// If you want the button to appear before the disclaimer element
// insertBefore will also place the new element as a sibling to the existing element, but it will appear immediately before it
$('<input type="button" value="toggle" id="toggleButton">').insertBefore('#disclaimer');

// If you want to add your new element as a child of an existing element
// then you can use the prependTo or appendTo functions
$('<strong>START!</strong>').prependTo('#disclaimer');
$('<strong>END!</strong>').appendTo('#disclaimer');


// Remove Elements
// To remove elements in jQuery, you first select them (as usual) with a selector, and then call the remove method
// The removeaction will remove all of the selected elements from the DOM, and will also remove any event handlers or data attached to those elements.
$('#no-script').remove();
// The removeaction does not require any parameters, though you can also specify an expression to refine the selection further.
// Rather than removing every trin the #celebsdiv, this code will remove only those rows which contain the text “Singer.”
$('#celebs tr').remove(':contains("Singer")');

// Modifying Content
// In this case, our paragraphs will contain bold-faced text, 
// but our h2tags will contain the entire content string exactly as defined, including the <strong>tags. 
// The action you use to modify content will depend on your requirements: text for plain text or html for HTML.
$('p').html('good bye, cruel paragraphs!');
$('h2').text('All your titles are belong to us');

// Fetch content
alert($('h2:first').text());


// Basic Animation: Hiding and Revealing with Flair
// Fading In and Out
// predefined words: slow, fast, or normal. For example: fadeIn('fast').
// fadeIn(1000)
$('#hideButton').click(function() {
	$('#disclaimer').fadeOut();
});


// Toggling Effects and Animations
$('#toggleButton').click(function() {
	$('#disclaimer').toggle('slow');
});


// Callback Functions
// Callbacks specify code that needs to run after the effect has finished doing whatever it needs to do. 
// In our case, when the slide has finished sliding it will run our callback code:
$('#disclaimer').slideToggle('slow', function() {
	alert('The slide has finished sliding!')
});


// Spoiler
$('.spoiler').hide();
$('<span class="revealer">Tell me!</span>').insertBefore('.spoiler');
$('.revealer').click(function() {
	$(this).hide();
	$(this).next().fadeIn();
});
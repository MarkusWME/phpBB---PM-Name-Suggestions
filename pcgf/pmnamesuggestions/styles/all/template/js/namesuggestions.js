var pcgfUserList = $('#username_list');
var pcgfSuggestionList = $('#pcgf_pmnamesuggestionlist');
var pcgfLastSearchValue = '';
var pcgfResultCount = 0;
var pcgfLastSelectedIndex = -1;
var pcgfKeyCatched = 0;

function hideSuggestions() {
	// Hide the suggestion list
	pcgfSuggestionList.css('display', 'none');
	pcgfSuggestionList.find('ul > li:nth-child(' + pcgfLastSelectedIndex + ')').removeClass('selected');
	pcgfLastSelectedIndex = -1;
}

function setSuggestionPosition() {
	// Position the suggestion list under the current line of the user list
	var userListPosition = pcgfUserList.position();
	var currentLine = pcgfUserList.val().substr(0, pcgfUserList.prop('selectionStart')).split('\n').length;
	pcgfSuggestionList.css({display: 'inline-block', left: userListPosition.left, top: userListPosition.top + (currentLine * parseInt(pcgfUserList.css('line-height'))) + 5});
}

function setPMName(name) {
	// Get the name without the image
	name = name.substr(name.indexOf('>') + 1);
	// Replace the current selected line with the new suggested name
	var currentPosition = pcgfUserList.prop('selectionStart');
	var searchValue = pcgfUserList.val();
	var startIndex = searchValue.lastIndexOf('\n', currentPosition - 1) + 1;
	var endIndex = searchValue.indexOf('\n', currentPosition);
	if (endIndex < 0) {
		endIndex = searchValue.length;
	}
	pcgfUserList.val(searchValue.substr(0, startIndex) + name + '\n' + searchValue.substr(endIndex));
	pcgfUserList.prop('selectionStart', startIndex + name.length + 1);
	pcgfUserList.prop('selectionEnd', startIndex + name.length + 1);
	hideSuggestions();
}

$(window).resize(function(e) {
	// Refresh the position of the suggestion list when the screen resizes
    setSuggestionPosition();
});

pcgfUserList.on('click', function() {
	// Refresh the list when something has been clicked inside the textarea
	pcgfUserList.trigger('keyup');
});

pcgfUserList.on('focusin', function() {
	// Show the suggestion list when the textarea get's focused
	pcgfUserList.trigger('keyup');
});

pcgfUserList.on('focusout', function(e) {
	// Hide the suggestion list when nothing is selected
	if (pcgfLastSelectedIndex > 0) {
		e.preventDefault();
		e.stopPropagation();
		return;
	}
	hideSuggestions();
});

pcgfUserList.on('keydown', function(e) {
	if (pcgfSuggestionList.css('display') !== 'none')
	{
		pcgfKeyCatched++;
		if (e.which === 13) {
			// Enter selects the current name and replaces the current line of the textarea
			pcgfSuggestionList.trigger('click');
			pcgfKeyCatched = 13;
		} else if (e.which === 27) {
			// Escape closes the current suggestion list
			hideSuggestions();
		} else if (e.which === 38) {
			// Up arrow selects the previous entry of the list
			if (pcgfKeyCatched % 3 === 1) {
				if (pcgfLastSelectedIndex <= 1) {
					pcgfLastSelectedIndex = pcgfResultCount;
					pcgfSuggestionList.find('ul > li:nth-child(' + pcgfResultCount + ')').addClass('selected');
					if (pcgfResultCount > 1) {
						pcgfSuggestionList.find('ul > li:nth-child(1)').removeClass('selected');
					}
				} else {
					pcgfSuggestionList.find('ul > li:nth-child(' + pcgfLastSelectedIndex + ')').removeClass('selected');
					pcgfLastSelectedIndex--;
					pcgfSuggestionList.find('ul > li:nth-child(' + pcgfLastSelectedIndex + ')').addClass('selected');
				}
			}
		} else if (e.which === 40) {
			// Down arrow selects the next entry of the list
			if (pcgfKeyCatched % 3 === 1) {
				if (pcgfLastSelectedIndex < 0 || pcgfLastSelectedIndex >= pcgfResultCount) {
					pcgfLastSelectedIndex = 1;
					pcgfSuggestionList.find('ul > li:nth-child(1)').addClass('selected');
					if (pcgfResultCount > 1) {
						pcgfSuggestionList.find('ul > li:nth-child(' + pcgfResultCount + ')').removeClass('selected');
					}
				} else {
					pcgfSuggestionList.find('ul > li:nth-child(' + pcgfLastSelectedIndex + ')').removeClass('selected');
					pcgfLastSelectedIndex++;
					pcgfSuggestionList.find('ul > li:nth-child(' + pcgfLastSelectedIndex + ')').addClass('selected');
				}
			}
		} else {
			pcgfKeyCatched = 0;
		}
		if (pcgfKeyCatched > 0) {
			e.preventDefault();
			e.stopPropagation();
			return;
		}
	}
});

pcgfUserList.on('keyup', function(e) {
	if (pcgfKeyCatched > 0) {
		pcgfKeyCatched = 0;
		e.preventDefault();
		e.stopPropagation();
		return;
	}
	// Any other key will lead to a refresh of the list
	var currentPosition = pcgfUserList.prop('selectionStart');
	var searchValue = pcgfUserList.val();
	var startIndex = searchValue.lastIndexOf('\n', currentPosition - 1) + 1;
	var endIndex = searchValue.indexOf('\n', currentPosition);
	if (endIndex < 0) {
		endIndex = searchValue.length;
	}
	hideSuggestions();
	searchValue = searchValue.substr(startIndex, endIndex - startIndex);
	if (searchValue !== pcgfLastSearchValue) {
		pcgfLastSearchValue = searchValue;
		$.ajax({url: './app.php/pcgf/pmnamesuggestions', type: 'POST', data: {search: searchValue}, success: function(result) {
			if (searchValue === pcgfLastSearchValue) {
				if (result === '<ul></ul>' || result === '') {
					// Make the suggestion list invisible if no match could be found
					pcgfLastSearchValue = '';
				} else {
					// If name is already entered don't show it
					var singleMatch = null;
					var matches = [];
					var regex = /<li.*?><img.*?\/>(.*?)<\/li>/gi;
					while ((singleMatch = regex.exec(result))) {
						matches.push(singleMatch[1]);
					}
					if (matches.length === 1 && matches[0] === searchValue) {
						pcgfLastSearchValue = '';
						return;
					}
					// Show the result list and refresh it's position
					pcgfSuggestionList.html(result);
					setSuggestionPosition();
					pcgfResultCount = pcgfSuggestionList.find('ul > li').length;
				}
			}
		}});
	} else if (pcgfLastSearchValue !== '' && pcgfSuggestionList.html() !== '') {
		setSuggestionPosition();
	}
});

pcgfSuggestionList.on('mousemove', 'ul > li', function() {
	// Select the list element where the cursor is above it
	if (pcgfLastSelectedIndex > 0) {
		pcgfSuggestionList.find('ul > li:nth-child(' + pcgfLastSelectedIndex + ')').removeClass('selected');
	}
	pcgfLastSelectedIndex = $(this).index() + 1;
	pcgfSuggestionList.find('ul > li:nth-child(' + pcgfLastSelectedIndex + ')').addClass('selected');
	
});

pcgfSuggestionList.on('mouseleave', function() {
	// Unselect the last selection of the suggestion
	if (pcgfLastSelectedIndex > 0) {
		pcgfSuggestionList.find('ul > li:nth-child(' + pcgfLastSelectedIndex + ')').removeClass('selected');
	}
	pcgfLastSelectedIndex = -1;
});

pcgfSuggestionList.on('click', function() {
	// Select the name
	if (pcgfLastSelectedIndex > 0) {
		setPMName(pcgfSuggestionList.find('ul > li:nth-child(' + pcgfLastSelectedIndex + ')').html());
		pcgfUserList.focus();
	}
});
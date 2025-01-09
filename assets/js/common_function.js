// Onload check the url and if g_id is present then set the game id
$(document).ready(function() {
    // on page load check the get params in URL
    var urlParams = new URLSearchParams(window.location.search);
    var g_id = urlParams.get('g_id');
    var g_name = urlParams.get('g_name');

    if (g_id) {
        get_game_details(g_id);
    }

    // disable the fields
    $('#number_of_bet_pairs').prop('disabled', true);
    $('#rupees_input').prop('disabled', true);
    $('#bet_row_input').prop('disabled', true);
});

function fetch_game_draw_data(game_id,date) {
    $.ajax({
        url: 'party_bet_details.php', // Path to your PHP script to fetch game draw data
        method: 'GET',
        data: {action: 'fetch_game_draw_data', game_id: game_id, date:date}, // Include the action parameter
        success: function(data) {
            // Check if response is an object
            if (data) {
                $('#row_bet').html(data); // Assuming #row_bet is a tbody element
            } else {
                // Handle errors here
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'There was an for fetching the party bet data from database. Please connect to the Support.',
                });
            }
        },
        error: function(xhr, status, error) {
            // Handle errors here
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an for fetching the party bet data from database. Please connect to the Support.',
            });
        }
    });
}

function delete_party_work(party_id) {
    // on page load check the get params in URL
    var urlParams = new URLSearchParams(window.location.search);
    var g_id = urlParams.get('g_id');
    var g_name = urlParams.get('g_name');

    if (g_id) {
        // show error you can not modify the party work as the game is declared
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'You can not modify the party work as the game is declared.',
        });
        return;
    }
    var game_id = $('#game').val(); // Get the selected game ID
    var date = $('#date').val(); // Get the selected date
    var user_id = $('#user_id').val();

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to delete all the party work?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX call to delete the party work
            $.ajax({
                url: 'party_bet_details.php', // Path to your PHP script
                type: 'GET',
                data: {
                    action: 'delete_party_work',
                    game_id: game_id,
                    date: date,
                    party_id: party_id
                }, // Include the necessary data
                success: function(response) {
                    try {
                        var parsedResponse = JSON.parse(response);

                        if (parsedResponse.error) {
                            // If the response contains an error, show the error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: parsedResponse.error,
                            });
                        } else {
                            // If success, show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The party work has been deleted successfully.',
                            }).then(() => {
                                // Optionally, refresh the page or remove the row
                                // location.reload(); // Refresh the page
                                fetch_game_draw_data(game_id,date);
                                // bet_details(game_id,date);
                                create_sheet("",1);
                                fetchPartyDetails(party_id, game_id, user_id, date); 
                                party_bet_details(party_id, game_id);
                            });
                        }
                    } catch (e) {
                        // If the response is not valid JSON, handle it as an error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Invalid response from the server.',
                        });
                    }
                },
                error: function() {
                    // Handle AJAX error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'There was an error deleting the party work. Please try again.',
                    });
                }
            });
        }
    });
}

function create_party_sheet(game_id,party_id){
    $.ajax({
        url: 'field_work.php', // Path to your PHP script to fetch game draw data
        method: 'GET',
        data: {action: 'party_sheet', game_id: game_id, party_id:party_id}, // Include the action parameter
        success: function(data) {
            // Append the received HTML data to the tbody
            $('#sheet').html(data); // Assuming #row_bet is a tbody element
            $('#final_sheet').append('<button class="close-button" onclick=close_sheet() id="close_button">&times;</button>'); // Add close button after content
            $('#final_sheet').css('display', 'block'); // Show the table
        },
        error: function(xhr, status, error) {
            // Handle errors here
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an for fetching the party bet data from database. Please connect to the Support.',
            });
        }
    });
}

function bet_header(type) {
    var data1 = `
        <tr>
            <td>No.</td>
            <td>Rs.</td>
            <td>No.</td>
            <td>Rs.</td>
            <td>No.</td>
            <td>Rs.</td>
            <td>No.</td>
            <td>Rs.</td>
            <td>No.</td>
            <td>Rs.</td>
            <td>No.</td>
            <td>Rs.</td>
        </tr>`;
        
    var data2 = `
        <tr>
            <td>No.</td>
            <td>Rs.</td>
            <td>No.</td>
            <td>Rs.</td>
            <td>No.</td>
            <td>Rs.</td>
            <td>No.</td>
            <td>Rs.</td>
            <td>No.</td>
            <td>Rs.</td>
        </tr>`;
    
    var data = (type == '1') ? data1 : data2;

    $('#bet_header').html(data);
}

function get_game_details(g_id){
    if(g_id){
        game_id = g_id;
    }else{
        var game_id = $('#game').val(); // Get the selected game ID
    }
    

    $.ajax({
        url: 'party_details.php',
        method: 'GET',
        data: {action: 'game_details', game_id: game_id},
        success: function(data) {
            try {
                var response = JSON.parse(data); // Parse the JSON data

                // Check if the response has an 'error' key
                if (response.error) {
                    // Show error message using SweetAlert
                    Swal.fire({
                        title: "Error",
                        text: response.error,
                        icon: "error",
                    });
                } else {
                    // Update form fields with the returned game details
                    $('#draw').val(response.draw);
                    $('#date').val(response.date_added);

                    // fetch_party_list();
                    $('#party_select2').prop('disabled', false);
                    fetch_party_list();
                    fetch_game_draw_data(game_id, response.date_added);
                    create_sheet("",1);
                    clear_party_details();
                }
            } catch (e) {
                Swal.fire({
                    title: "Error",
                    text: "Invalid response from the server.",
                    icon: "error",
                });
            }
        },
        error: function() {
            Swal.fire({
                title: "Error",
                text: "There was a problem with the request.",
                icon: "error",
            });
        }
    });
}

function fetch_party_list(){
    // check the value of fetch_party_list
    let fetch_party = $('#fetch_party').val();
    $.ajax({
        url: 'party_details.php',
        method: 'GET',
        data: {action: 'party_list', fetch_party: fetch_party},
        success: function(data) {
            try {
                // Try to handle data or check if it's a valid response
                if (data.trim() === '') {
                    throw new Error("No party list found.");
                }
                $('#party_select2').prop('disabled', false);
                $('#party_select2').html(data); // Populate party dropdown or element
            } catch (e) {
                // Show error using SweetAlert if there's an issue
                Swal.fire({
                    title: "Error",
                    text: e.message || "Error fetching party list.",
                    icon: "error",
                });
            }
        },
        error: function() {
            // Handle AJAX error
            Swal.fire({
                title: "Error",
                text: "There was a problem fetching the party list.",
                icon: "error",
            });
        }
    });
}

document.getElementById('bet_row_input').addEventListener('keypress', function(event) {
    const invalidChars = ['+', 'e', 'E', '.'];
            // Check if the pressed key is in the invalidChars array
            if (invalidChars.includes(event.key)) {
                event.preventDefault();  // Prevent the character from being entered
            }

            // Disable up arrow (ArrowUp) and down arrow (ArrowDown)
            if (event.key === "ArrowUp" || event.key === "ArrowDown") {
                event.preventDefault(); // Prevent the number from changing
            }
    if (event.keyCode === 13 || event.which === 13) {
        event.preventDefault(); // Prevent form submission if 'Enter' key is pressed
        try {
            // Validate the input
            var check1 = datavalidator();
            var check = JSON.parse(check1); // Parse the response from datavalidator

            // Check if 'check' is an object with an error key
            if (typeof check === "object" && check !== null && check.error) {
                // Show error message if the object has an error
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: check.error,
                });
            } 
            // If it's an array
            else if (Array.isArray(check)) {
                // Process the array if needed (currently left empty for future use)
            } 
            // If check returned true, continue processing the bet string
            else if (check === true) {
                let inputValue = event.target.value.trim();
                if (inputValue !== "") {
                    
                    if(inputValue === 'S1' || inputValue === 's1' || inputValue === 'S2' || inputValue === 's2'){
                        return validateBetString(inputValue);
                    }
                    // Validate the bet string
                    let betStringResponse = validateBetString(inputValue);
                                       
                    // If the response is a valid array of numbers
                    let betStringResponseParsed = JSON.parse(betStringResponse);
                    if (typeof betStringResponseParsed === "object" && betStringResponseParsed !== null && betStringResponseParsed.error) {
                        // Show error message from the parsed response
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: betStringResponseParsed.error,
                        });
                    }
                    // If betStringResponse is a JSON string (error message)
                    else {
                        // Set the number of bet pairs
                        let numberOfPairs = betStringResponseParsed.length;
                        document.getElementById('number_of_bet_pairs').value = numberOfPairs;
                        
                        // Shift focus to the 'rupees_input' input
                        document.getElementById('rupees_input').focus();
                    }
                }
            }
        } catch (error) {
            // Show a generic error message if there's an unexpected issue
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'An unexpected error occurred.',
            });
        }
    }
});

function get_party_details(){
        // Clear the party field
        $('#party').val(''); 

        // Get the selected value from the Select2 dropdown
        var party_select2 = $('#party_select2').val();

        // Set the party field to the selected value
        $('#party').val(party_select2);
        var party_id = $('#party').val(); // Get the selected party ID
        var game_id = $('#game').val(); // Get the selected game ID
        var user_id = $('#user_id').val(); // Assuming there is an element with id 'user_id'
        var date = $('#date').val(); // Get the selected date

        //set focus on the bet_row_input
        // on page load check the get params in URL
        var urlParams = new URLSearchParams(window.location.search);
        var g_id = urlParams.get('g_id');
        var g_name = urlParams.get('g_name');
        fetchPartyDetails(party_id, game_id, user_id, date);
        party_bet_details(party_id, game_id);
        if (g_id) {
            // disable the fields
            $('#number_of_bet_pairs').prop('disabled', true);
            $('#rupees_input').prop('disabled', true);
            $('#bet_row_input').prop('disabled', true);
        }else{
            // disable the fields
            $('#number_of_bet_pairs').prop('disabled', false);
            $('#rupees_input').prop('disabled', false);
            $('#bet_row_input').prop('disabled', false);
            $('#rupees_input').val('');
            $('#bet_row_input').val('');
            $('#number_of_bet_pairs').val('');
            // close the select2 dropdown
            $('#party_select2').select2('close');
        }
        // set focus on the bet_row_input
        setTimeout(function () {
            $('#bet_row_input').focus();
        }, 100);
}

$(document).ready(function() {
    $('#rupees_input').keypress(function(event) {
        if (event.keyCode === 13 || event.which === 13) {
            event.preventDefault(); // Prevent default action (form submission)

            var betValue = $('#bet_row_input').val();
            var inputValue = $(this).val();

            if (inputValue.trim() !== "") {
                var betStringResponse = validateBetString(betValue);

                try {
                    let betStringResponseParsed = JSON.parse(betStringResponse);

                    if (typeof betStringResponseParsed === "object" && betStringResponseParsed !== null && betStringResponseParsed.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: betStringResponseParsed.error,
                        });
                    } else if (Array.isArray(betStringResponseParsed)) {
                        var numberOfPairs = betStringResponseParsed.length;
                        $('#number_of_bet_pairs').val(numberOfPairs);

                        // Store the variables required for AJAX request
                        var partyId = $('#party').val();
                        var amount = $('#rupees_input').val();
                        var gameId = $('#game').val();
                        var betString = $('#bet_row_input').val();
                        var noOfPair = $('#number_of_bet_pairs').val();
                        var pati = $('#pati').val();
                        var date = $('#date').val();
                        var user_id = $('#user_id').val();
                        var crd_id = $('#crd_id').val();
                        var action_type = $('#action').val();

                        // Clear input fields and focus on the next entry
                        $('#bet_row_input').val('');
                        $('#rupees_input').val('');
                        $('#number_of_bet_pairs').val('');
                        $('#bet_row_input').focus();

                        // Continue with the AJAX request
                        $.ajax({
                            url: 'bet_insertion.php',
                            method: 'GET',
                            data: {
                                action: 'row_input',
                                party_id: partyId,
                                game_id: gameId,
                                bet_string: betString,
                                amount: amount,
                                betStringResponse: betStringResponseParsed,
                                noOfPair: noOfPair,
                                pati: pati,
                                date: date,
                                crd_id: crd_id,
                                action_type: action_type,
                            },
                            success: function(response) {
                                var parsedResponse = JSON.parse(response);
                                if (typeof parsedResponse === 'object' && parsedResponse !== null) {
                                    if (parsedResponse.error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error!',
                                            text: parsedResponse.error,
                                        });
                                    } else if (crd_id != "" && action_type == 'edit') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Updated!',
                                            text: 'The sheet has been updated successfully.',
                                        }).then(() => {
                                            // Call other functions if needed
                                            fetch_game_draw_data(gameId, date);
                                            create_sheet("",1);
                                            fetchPartyDetails(partyId, gameId, user_id, date);
                                            party_bet_details(partyId, gameId);
                                        });
                                        // rest the action and crd_id
                                        $('#action').val('');
                                        $('#crd_id').val('');
                                    } else {
                                        // Call other functions if needed
                                        fetch_game_draw_data(gameId, date);
                                        create_sheet("",1);
                                        fetchPartyDetails(partyId, gameId, user_id, date);
                                        party_bet_details(partyId, gameId);
                                    }
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: 'There was an error processing your request. Please try again.',
                                });
                            }
                        });
                    }
                } catch (e) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An unexpected error occurred.',
                    });
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Please enter a valid string.',
                });
            }
        }
    });
});


function fetchPartyDetails(party_id, game_id, user_id, date) {
    $.ajax({
        url: 'party_details.php', // Path to your PHP script to fetch party details
        method: 'GET',
        data: {
            action: 'party_details',
            party_id: party_id,
            game_id: game_id,
            user_id: user_id,
            date: date
        }, // Include all defined variables
        success: function(data) {
            try {
                // Try to parse the response data as JSON
                var response = JSON.parse(data);

                // Check if response is an object
                if (typeof response === 'object' && response !== null) {
                    // Update form fields with the returned party details
                    $('#pati').val(response.pati);
                    $('#limit').val(response.limit);
                    $('#total').val(response.total); // Assuming there's an input field for total bet
                    // Remove and Update the party name
                    $('#party_name_heading').html(response.party_name);
                } else {
                    // Show SweetAlert if response is not an object
                    Swal.fire({
                        title: 'Warning',
                        text: 'Unexpected response: ' + data,
                        icon: 'warning',
                    });
                }
            } catch (e) {
                // Reset the values if JSON parsing fails
                $('#pati').val('');
                $('#limit').val('');
                $('#total').val(''); // Assuming there's an input field for total bet
                
                // Show SweetAlert with raw response data
                Swal.fire({
                    title: 'Error',
                    text: 'Invalid response from the server: ' + data,
                    icon: 'error',
                });
            }
        },
        error: function() {
            // Handle AJAX error (e.g., network issue)
            Swal.fire({
                title: 'Error',
                text: 'There was a problem with the request.',
                icon: 'error',
            });
        }
    });
}

function datavalidator(){
    
    var party_id = $('#party').val(); // Get the selected party ID
    var game_id = $('#game').val(); // Get the entered amount
    var date = $('#date').val(); // Get the bet string
    var pati = $('#pati').val(); // Get the bet string
    var draw = $('#draw').val(); // Get the bet string

    if(game_id == 'undefined' || game_id == null || game_id == ""){
        return JSON.stringify({ error: "Game is not selected to insert the bet." });
    }else if(party_id == 'undefined' || party_id == null || party_id == ""){
        return JSON.stringify({ error: "Party is not selected to insert the bet." });
    }else if(pati == 'undefined' || pati == null || pati == ""){
        return JSON.stringify({ error: "Patti is not defined to insert the bet." });
    }else if(draw == 'undefined' || draw == null || draw == ""){
        return JSON.stringify({ error: "Draw is not selected to insert the bet." });
    }else if(date == 'undefined' || date == null || date == ""){
        return JSON.stringify({ error: "Date is not selected to insert the bet." });
    }else{
        $error = true;
    }
    return $error;
}

function validateBetString(betString) {
    var parts = betString.split('*'); // Split the bet string by '*'
    var mainPart = parts[0].trim(); // Get the main part before '*'
    var additionalPart = parts[1] ? parts[1].trim() : ''; // Get the additional part after '*'

    if(betString === 'S1' || betString === 's1' || betString === 'S2' || betString === 's2'){
        return bet_string(mainPart);
    }
    // Validate main part
    var mainPartArray = [];
    if (mainPart !== '') {
        mainPartArray = bet_string(mainPart); // Assuming bet_string() returns an array or error
    }

    // Validate additional part
    var removeArray = [];
    if (additionalPart !== '') {
        // If additional part is not empty, process it
        if (/^\d+$/.test(additionalPart)) {
            // If additional part consists of only numbers, check if digit count is even
            if (additionalPart.length % 2 === 0) {
                // If digit count is even, create remove array of 2-digit numbers
                for (var i = 0; i < additionalPart.length; i += 2) {
                    if(additionalPart.substr(i, 2) == '00'){
                        removeArray.push(100);
                    }else{
                        removeArray.push(parseInt(additionalPart.substr(i, 2)));
                    }
                }
            } else {
                // Return error for incorrect digit count
                return JSON.stringify({ error: "Remove part digit count is not correct." });
            }
        } else {
            // Return error for invalid format in remove part
            return JSON.stringify({ error: "Invalid remove part format." });
        }
    }

    if (Array.isArray(mainPartArray)) {
        // Check for any error in the main part array
        if (mainPartArray.error) {
            return JSON.stringify({ error: mainPartArray.error });
        } else {
            // Apply remove array to main part array
            mainPartArray = mainPartArray.filter(function(item) {
                return !removeArray.includes(item);
            });
        }
    } else {
        //parse the main part array
        mainPartArray1 = JSON.parse(mainPartArray);
        if (typeof mainPartArray1 === "object" && mainPartArray1 !== null) {
            // Check if the object contains the 'error' key
            if (mainPartArray1.error) {
                return JSON.stringify({ error: mainPartArray1.error });
            }
        }
    }

    // Return the final processed array as JSON
    return JSON.stringify(mainPartArray);
}

function bet_string(inputValue){
    // Switch case based on the input value
    switch (true) {
        case /^\d+$/.test(inputValue):
            $arr = numbers_nos(inputValue);
            break;
        case /-/.test(inputValue):
            $arr = ginti(inputValue);
            break;
        case /\//.test(inputValue):
            $arr = crossing(inputValue);
            break;
        case /^[Aa]\d*$/.test(inputValue):
            $arr = andar(inputValue);
            break;
        case /^[Bb]\d*$/.test(inputValue):
            $arr = bahar(inputValue);
            break;
        case (inputValue.startsWith('AB') || inputValue.startsWith('ab')):
            $arr = andar_bahar(inputValue);
            break;
        case (inputValue === 'S1' || inputValue === 's1' || inputValue === 'S2' || inputValue === 's2'):
            $arr = sheet(inputValue);
            break;
        default:
            $arr = JSON.stringify({ error: "Input doesn't match any case." });
    }
    return $arr;
}

function numbers_nos(str) {
    // Check if the string is empty
    if (str.length === 0) {
        return JSON.stringify({ error: "Input string cannot be empty." });
    }
    
    // Check if the string length is odd
    if (str.length % 2 !== 0) {
        return JSON.stringify({ error: "Input string must have even length." });
    }

    // Create an array to store the numbers
    let numbers = [];

    // Iterate over the string and extract numbers
    for (let i = 0; i < str.length; i += 2) {
        // Get the current substring of length 2
        let substr = str.substr(i, 2);

        // Convert '00' to '100'
        if (substr === '00') {
            numbers.push(100);
        } else {
            numbers.push(parseInt(substr));
        }
    }
    return numbers;
}

function ginti(str) {
    // Check if the string is empty
    if (str.length === 0) {
        return JSON.stringify({ error: "Input string cannot be empty." });
    }

    // Split the string by '-' to get the range
    let range = str.split('-');

    // Check if the range contains two elements
    if (range.length !== 2) {
        return JSON.stringify({ error: "Invalid input format." });
    }

    // Parse the start and end numbers
    let start = parseInt(range[0]);
    let end = parseInt(range[1]);

    // Validate the range
    if (isNaN(start) || isNaN(end) || start < 1 || end > 100 || start > end) {
        return JSON.stringify({ error: "Invalid range (Range must be between 1 and 100)." });
    }

    // Generate the array of numbers
    let numbers = [];
    for (let i = start; i <= end; i++) {
        numbers.push(i);
    }

    return numbers;
}

function andar(str) {
    // Check if the string is empty
    if (str.length === 0) {
        return JSON.stringify({ error: "Input string cannot be empty." });
    }

    // Initialize an array to store the result
    let result = [];

    // Iterate over the characters of the string
    for (let i = 1; i < str.length; i++) {
        // Check if the character is a digit
        if (!isNaN(parseInt(str[i]))) {
            // Append 'a' followed by the digit to the result array
            result.push('a' + str[i]);
        }
    }

    return result;
}

function bahar(str) {
    // Check if the string is empty
    if (str.length === 0) {
        return JSON.stringify({ error: "Input string cannot be empty." });
    }

    // Initialize an array to store the result
    let result = [];

    // Iterate over the characters of the string
    for (let i = 1; i < str.length; i++) {
        // Check if the character is a digit
        if (!isNaN(parseInt(str[i]))) {
            // Append 'a' followed by the digit to the result array
            result.push('b' + str[i]);
        }
    }

    return result;
}

function crossing(betString) {
    // Check if the string is empty
    if (betString.length === 0) {
        return JSON.stringify({ error: "Input string cannot be empty." });
    }

    if (betString.includes('J') || betString.includes('j')) {
        return crossing_without_pair(betString);
    } else if (/\//.test(betString)) {
        return crossing_with_pair(betString);
    } else {
        return JSON.stringify({ error: "Invalid input format." });
    }
}

function crossing_without_pair(betString) {
    // Check if the string is empty
    if (betString.length === 0) {
        return JSON.stringify({ error: "Input string cannot be empty." });
    }

    var numbers = [];
    var parts = betString.split('/');
    if (betString.includes('J')) {
        var part = parts[0].split('J');
    } else {
        var part = parts[0].split('j');
    }
    var firstDigits = part[1].split('');
    var secondDigits = parts[1].split('');

    firstDigits.forEach(function(firstDigit) {
        secondDigits.forEach(function(secondDigit) {
            if (firstDigit !== secondDigit) {
                numbers.push(parseInt(firstDigit + secondDigit));
            }
        });
    });

    return numbers;
}

function crossing_with_pair(betString) {
    // Check if the string is empty
    if (betString.length === 0) {
        return JSON.stringify({ error: "Input string cannot be empty." });
    }

    var numbers = [];
    var parts = betString.split('/');
    var firstDigits = parts[0].split('');
    var secondDigits = parts[1].split('');

    firstDigits.forEach(function(firstDigit) {
        secondDigits.forEach(function(secondDigit) {
            if (firstDigit === '0' && secondDigit === '0') {
                numbers.push(100); // Append 100 if both digits are 0
            }else {
                numbers.push(parseInt(firstDigit + secondDigit));
            }
        });
    });

    return numbers;
}

function andar_bahar(betString) {

    // Check if the string is empty
    if (betString.length === 0) {
        return JSON.stringify({ error: "Input string cannot be empty." });
    }

    if (betString.startsWith('AB') || betString.startsWith('ab')) {
        var numbers = [];
        var digits = betString.substring(2).split('');

        digits.forEach(function(digit, index) {
                numbers.push('a' + digit);
                numbers.push('b' + digit);
        });

        return numbers;
    } else {
        return JSON.stringify({ error: "Bet string does not start with 'AB'." });
    }
}

// Function to fetch party bet details
function party_bet_details(party_id,game_id) {
    if (party_id == "" || game_id == "") {
        // show swal error message
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please select a party to fetch the party bet details.',
        });
        return;
    }
    $.ajax({
        url: 'bet_insertion.php', // Path to your PHP script to fetch party details
        method: 'GET',
        data: {action: 'party_bet_details', party_id: party_id, game_id: game_id}, // Include the action parameter
        success: function(data) {
            try {
                // Parse the response data as JSON
                var response = JSON.parse(data);
    
                if (!response.error) {
                    // If no error, insert the HTML into the table body
                    $('#bet_numbers').html(response.html); // Assuming response.html contains the table rows HTML
                    
                    // Scroll to the bottom of the table
                    var tableWrapper = $('.first-table-wrapper');
                    tableWrapper.scrollTop(tableWrapper[1].scrollHeight);
                } else {
                    // Show a SweetAlert error message if there's an error in the response
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || "An error occurred while fetching data.",
                    });
                }
            } catch (e) {
                // Handle JSON parsing errors
                console.error("Failed to parse JSON response: ", e);
                Swal.fire({
                    icon: 'error',
                    title: 'Unexpected Error',
                    text: 'The server returned an invalid response. Please try again.',
                });
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX request errors
            console.error("AJAX error:", status, error);
            Swal.fire({
                icon: 'error',
                title: 'Request Failed',
                text: 'Unable to fetch data. Please check your connection or try again later.',
            });
        }
    });
}

function clear_party_details(){
    $('#pati').val('');
    $('#limit').val('');
    $('#total').val('');
    $('#party_search').val('');
    $('#bet_numbers').html('');
    $('#rupees_input').val('');
    $('#bet_row_input').val('');
    $('#number_of_bet_pairs').val('');
}

function create_sheet(party = "", sheet_type_direct = "", round_by = "") {
    var game_id = $('#game').val(); // Get the selected game ID
    var date = $('#date').val(); // Get the selected date
    var sheet_type = $('#sheetDropdown').val(); // Get the selected sheet type
    if (sheet_type_direct != "") {
        sheet_type = sheet_type_direct;
    }

    // Show error message if game is not selected
    if (game_id == "") {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please select a game to create the sheet.',
        });
        return;
    }

    if (sheet_type === 0 && party != "") {
        // Show error message if sheet type is not selected
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please use sheet option in Party Bet Details.',
        });
        return;
    }
    if (sheet_type == 2 || sheet_type == 4 || sheet_type == 3) {
        // check all the entry from coupon_row_data table inserted into main sheet
        entry_checker();
    }

    $.ajax({
        url: 'sheet.php', // Path to your PHP script to fetch game draw data
        method: 'GET',
        data: {
            action: 'final_sheet',
            game_id: game_id,
            date: date,
            party: party,
            sheet_type: sheet_type,
            round_by: round_by
        },
        success: function(data) {
            try {
                var response = JSON.parse(data);

                // Check if response is an object and doesn't contain an error
                if (typeof response === 'object' && response !== null) {
                    // Update the HTML sheet
                    $('#bet').html(response.sheet);
                    // Update sheet title
                    $('#sheet-title').html(response.sheet_title);

                    // Set the sheet header (assuming bet_header is a function)
                    bet_header(response.sheet_type);

                    // copy the sheet to clipboard
                    navigator.clipboard.writeText(response.sheet_data)
                        .then(() => {
                            // Swal.fire({
                            // icon: 'success',
                            // title: 'Success',
                            // text: 'The party details has been copied successfully.',
                            // });
                        })

                    // Update form fields with the sum values
                    $('#01-10').val(response.sum["01-10"]);
                    $('#11-20').val(response.sum["11-20"]);
                    $('#21-30').val(response.sum["21-30"]);
                    $('#31-40').val(response.sum["31-40"]);
                    $('#41-50').val(response.sum["41-50"]);
                    $('#51-60').val(response.sum["51-60"]);
                    $('#61-70').val(response.sum["61-70"]);
                    $('#71-80').val(response.sum["71-80"]);
                    $('#81-90').val(response.sum["81-90"]);
                    $('#91-100').val(response.sum["91-100"]);
                    $('#a0-a9').val(response.sum["a0-a9"]);
                    $('#b0-b9').val(response.sum["b0-b9"]);
                    $('#total_bet').val(response.sum["total_bet"]);

                    if (sheet_type == 1 || sheet_type == 3) {
                        // Summing the values for 'AB'
                        $('#AB').val(
                            parseFloat(response.sum["a0-a9"] || 0) + parseFloat(response.sum["b0-b9"] || 0)
                        );

                        // Summing the values for '01-100'
                        $('#01-100').val(
                            parseFloat(response.sum["01-10"] || 0) +
                            parseFloat(response.sum["11-20"] || 0) +
                            parseFloat(response.sum["21-30"] || 0) +
                            parseFloat(response.sum["31-40"] || 0) +
                            parseFloat(response.sum["41-50"] || 0) +
                            parseFloat(response.sum["51-60"] || 0) +
                            parseFloat(response.sum["61-70"] || 0) +
                            parseFloat(response.sum["71-80"] || 0) +
                            parseFloat(response.sum["81-90"] || 0) +
                            parseFloat(response.sum["91-100"] || 0)
                        );
                        $('.01-100').css('display', '');
                        $('.AB').css('display', '');
                    } else {
                        $('#AB').val('');
                        $('#01-100').val('');
                        // display none to the class 01-100 and AB
                        $('.01-100').css('display', 'none');
                        $('.AB').css('display', 'none');
                    }

                    // Select party sheet in case party is selected
                    if (party !== "") {
                        $('#sheetDropdown').val('0');
                    } else {
                        $('#sheetDropdown').val(sheet_type);
                    }
                } else {
                    // Reset fields if response is not an object
                    resetFields();
                }
            } catch (e) {
                // Show error message
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Invalid response from the server.',
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", error);

            // Handle AJAX error
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was an error processing your request. Please try again.',
            });
        }
    });
}

function resetFields() {
    $('#1-10').val('0');
    $('#11-20').val('0');
    $('#21-30').val('0');
    $('#31-40').val('0');
    $('#41-50').val('0');
    $('#51-60').val('0');
    $('#61-70').val('0');
    $('#71-80').val('0');
    $('#81-90').val('0');
    $('#91-100').val('0');
    $('#a0-a9').val('0');
    $('#b0-b9').val('0');
    $('#total_bet').val('0');
}

function fetch_bet_numbers(){
    var party_id = $('#party').val(); // Get the selected party ID
    var game_id = $('#game').val(); // Get the selected game ID
    $.ajax({
        url: 'bet_numbers.php', // Path to your PHP script to fetch game draw data
        method: 'GET',
        data: {action: 'bet_numbers', game_id: game_id, player_id: party_id}, // Include the action parameter
        success: function(data) {
            // Append the received HTML data to the tbody
            $('#bet_numbers').html(data); // Assuming #row_bet is a tbody element
        },
        error: function(xhr, status, error) {
            console.error("Error occurred:", error);
        }
    });
}

function delete_bet(crd_id){
    // on page load check the get params in URL
    var urlParams = new URLSearchParams(window.location.search);
    var g_id = urlParams.get('g_id');
    var g_name = urlParams.get('g_name');

    if (g_id) {
        // show error you can not modify the party work as the game is declared
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'You can not modify the party work as the game is declared.',
        });
        return;
    }

    var game_id = $('#game').val(); // Get the selected game ID
    var date = $('#date').val(); // Get the selected date
    var user_id = $('#user_id').val();
    var party_id = $('#party').val();

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to delete the bet?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // AJAX call to delete the bet
            $.ajax({
                url: 'bet_insertion.php', // Path to your PHP script
                type: 'GET',
                data: {
                    action: 'delete_bet',
                    game_id: game_id,
                    date: date,
                    crd_id: crd_id,
                    user_id: user_id
                }, // Include the necessary data
                success: function(response) {
                    try {
                        var parsedResponse = JSON.parse(response);

                        if (parsedResponse.error) {
                            // If the response contains an error, show the error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: parsedResponse.error,
                            });
                        } else {
                            // If success, show success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'The bet has been deleted successfully.',
                            }).then(() => {
                                // Optionally, refresh the page or remove the row
                                // location.reload(); // Refresh the page
                                fetch_game_draw_data(game_id,date);
                                // bet_details(game_id,date);
                                create_sheet("",1);
                                fetchPartyDetails(party_id, game_id, user_id, date);
                                party_bet_details(party_id, game_id);
                            });
                        }
                    } catch (e) {
                        // If the response is not valid JSON, handle it as an error
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Invalid response from the server.',
                        });
                    }
                },
                error: function() {
                    // Handle AJAX error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'There was an error deleting the bet. Please try again.',
                    });
                }
            });
        }
    });
}

function sheet(inputValue) {
    // Fetch the details
    var party_id = $('#party').val();
    var game_id = $('#game').val();
    var date = $('#date').val();
    var user_id = $('#user_id').val();

    // AJAX call to fetch the HTML content of the sheet
    $.ajax({
        url: 'sheet.php', // Path to your PHP script to fetch game draw data
        method: 'GET',
        data: {
            action: 'sheet', 
            inputValue: inputValue, 
            party_id: party_id, 
            game_id: game_id, 
            date: date, 
            user_id: user_id
        },
        success: function(data) {
            // Append the received HTML data to the swal popup
            Swal.fire({
                title: 'Jantri',
                html: data,
                width: 800,
                showCloseButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Save it!',
                allowOutsideClick: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Call the function to save the sheet
                    save_sheet();
                }
            });
        },
        error: function(xhr, status, error) {
            // Handle errors here
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an error fetching the party bet data from the database. Please contact Support.',
            });
        }
    });
}

function moveFocus(event) {
    // Select all inputs of type 'number'
    const numberInputs = document.querySelectorAll('input[type="number"]');

    // Loop through all the number inputs and add event listeners
    numberInputs.forEach(function(numberInput) {
        numberInput.addEventListener('keydown', function(event) {
            const invalidChars = ['/', '-', '*', '+', 'e', 'E', '.'];
            // Check if the pressed key is in the invalidChars array
            if (invalidChars.includes(event.key)) {
                event.preventDefault();  // Prevent the character from being entered
            }

            // Disable up arrow (ArrowUp) and down arrow (ArrowDown)
            if (event.key === "ArrowUp" || event.key === "ArrowDown") {
                event.preventDefault(); // Prevent the number from changing
            }
        });
    });

    // Check if the form with id 'jantri_sheet' is currently displayed inside a Swal pop-up
    let jantriForm = document.querySelector('.swal2-popup #jantri_sheet');
    
    if (jantriForm && event.key === "Enter") {  // Check if the form exists and Enter is pressed
        event.preventDefault();
        let sheetType = document.querySelector('.swal2-popup #sheet').value;

        // If the sheet type is 'S1' then calculate the total for the 01-10, 11-20, 21-30,31-40,41-50,51-60,61-70,71-80,81-90,91-100,A0-A9,B0-B9
        if(sheetType === 'S1' || sheetType === 's1'){
            const focusedElement = event.target;
            const focusedId = focusedElement.id;
            const nextFocusId = parseInt(focusedId) + 1;

            // check if the nextFocusID is NaN 
            if(isNaN(nextFocusId)){
                // check the focus element have A or B and add 1 in numeric part
                let firstPart = focusedId.slice(0, 1); // Take the first digit
                let secondPart = focusedId.slice(1); // Take the last digit
                let newSecondPart = parseInt(secondPart) + 1;
                let newNextFocusId = firstPart + newSecondPart;

                if(newNextFocusId === 'a10'){ 
                    const element = document.getElementById('b0');
                    element.focus();
                }else if(newNextFocusId === 'b10'){
                    const element = document.querySelector('.swal2-confirm');
                    element.focus();
                }else{
                    const element = document.getElementById(newNextFocusId);
                    element.focus();
                }
            }else{            
                // If elementId is between 1 and 9, add a leading zero
                if (nextFocusId >= 1 && nextFocusId <= 9) {
                    newNextFocusId = '0' + nextFocusId; // Convert to string with leading zero
                } else {
                    newNextFocusId = nextFocusId.toString(); // Convert to string to match element ID format
                }

                const element = document.getElementById(newNextFocusId);
                if(parseInt(newNextFocusId) <= 100){
                    element.focus();
                }else{
                    const element = document.getElementById('a0');
                    element.focus();
                }
            }
            calculateTotal('S1');
        }else{
            const focusedElement = event.target;
            const focusedId = focusedElement.id;
            let nextFocusId = parseInt(focusedId) + 10; // Add 10 to the current ID

             // check if the nextFocusID is NaN 
             if(isNaN(nextFocusId)){
                // check the focus element have A or B and add 1 in numeric part
                let firstPart = focusedId.slice(0, 1); // Take the first digit
                let secondPart = focusedId.slice(1); // Take the last digit
                let newSecondPart = parseInt(secondPart) + 1;
                let newNextFocusId = firstPart + newSecondPart;

                if(newNextFocusId === 'a10'){ 
                    const element = document.getElementById('b0');
                    element.focus();
                }else if(newNextFocusId === 'b10'){
                    const element = document.querySelector('.swal2-confirm');
                    element.focus();
                }else{
                    const element = document.getElementById(newNextFocusId);
                    element.focus();
                }
            }else{
                // If nextFocusId equals 100, we focus on element with ID '100'
                if (nextFocusId === 110) {
                    const element = document.getElementById('a0');
                    if (element) {
                        element.focus();
                    }
                } else if (nextFocusId > 100) {
                    // Logic to handle IDs greater than 100
                    nextFocusId = nextFocusId.toString();

                    // Split the ID into parts, assuming it's a 3-character ID
                    let firstPart = nextFocusId.slice(0, 2); // Take the first two digits
                    let secondPart = nextFocusId.slice(2); // Take the last digit
                
                    let newSecondPart = parseInt(secondPart) + 1;
                
                    // Add a leading '0' if necessary
                    if (newSecondPart >= 1 && newSecondPart <= 9) {
                        newSecondPart = '0' + newSecondPart;
                    }
                
                    let newNextFocusId = newSecondPart;
                
                    const element = document.getElementById(newNextFocusId);
                    if (element) {
                        element.focus();
                    }
                } else {
                    // Handle other cases, where IDs are below 100
                    let newNextFocusId = nextFocusId.toString();

                    // Add a leading zero if the ID is between 1 and 9
                    if (nextFocusId >= 1 && nextFocusId <= 9) {
                        newNextFocusId = '0' + newNextFocusId;
                    }
                
                    const element = document.getElementById(newNextFocusId);
                    if (element) {
                        element.focus();
                    }
                }
            }
            calculateTotal('S2');
        }
    }
}

function calculateTotal(sheetType) {
    // Get the form inputs for the sheet type 'S1'
    let formInputs = Array.from(document.querySelectorAll('.swal2-popup #jantri_sheet input[type="number"]'));

    // initialize variables
    let totals = {
        total_01_10: 0,
        total_11_20: 0,
        total_21_30: 0,
        total_31_40: 0,
        total_41_50: 0,
        total_51_60: 0,
        total_61_70: 0,
        total_71_80: 0,
        total_81_90: 0,
        total_91_100: 0,
        total_a0_a9: 0,
        total_b0_b9: 0,
        total_01_91: 0,
        total_02_92: 0,
        total_03_93: 0,
        total_04_94: 0,
        total_05_95: 0,
        total_06_96: 0,
        total_07_97: 0,
        total_08_98: 0,
        total_09_99: 0,
        total_10_100: 0,
        jantri_total: 0,
        game_total: 0,
        total_01_100: 0
    };

    const allowedIds = [
        '01-10', '11-20', '21-30', '31-40', '41-50', '51-60', '61-70', 
        '71-80', '81-90', '91-100', 'a0-a9', 'b0-b9', '01-91', '02-92', 
        '03-93', '04-94', '05-95', '06-96', '07-97', '08-98', '09-99', '10-100','AB','jantri_total','01-100','total_bet','game_total'
    ];
    totals.game_total = document.getElementById('game_total').value;

    // Iterate over the form inputs
    formInputs.forEach(function (input) {
        let value = parseInt(input.value) || 0;
        let id = input.id;
        let numericId = parseInt(id);
        if( value > 0){
            if (!allowedIds.includes(numericId)) {
                if (sheetType === 'S1' || sheetType === 's1') {
                    if (['01', '02', '03', '04', '05', '06', '07', '08', '09', '10'].includes(id)) totals.total_01_10 += value;
                    if (['11', '12', '13', '14', '15', '16', '17', '18', '19', '20'].includes(id)) totals.total_11_20 += value;
                    if (['21', '22', '23', '24', '25', '26', '27', '28', '29', '30'].includes(id)) totals.total_21_30 += value;
                    if (['31', '32', '33', '34', '35', '36', '37', '38', '39', '40'].includes(id)) totals.total_31_40 += value;
                    if (['41', '42', '43', '44', '45', '46', '47', '48', '49', '50'].includes(id)) totals.total_41_50 += value;
                    if (['51', '52', '53', '54', '55', '56', '57', '58', '59', '60'].includes(id)) totals.total_51_60 += value;
                    if (['61', '62', '63', '64', '65', '66', '67', '68', '69', '70'].includes(id)) totals.total_61_70 += value;
                    if (['71', '72', '73', '74', '75', '76', '77', '78', '79', '80'].includes(id)) totals.total_71_80 += value;
                    if (['81', '82', '83', '84', '85', '86', '87', '88', '89', '90'].includes(id)) totals.total_81_90 += value;
                    if (['91', '92', '93', '94', '95', '96', '97', '98', '99', '100'].includes(id)) totals.total_91_100 += value;
                } else {
                    // Handle ranges for the non-'S1' case
                    switch (id) {
                        case '01': case '11': case '21': case '31': case '41': case '51': case '61': case '71': case '81': case '91':
                            totals.total_01_91 += value;
                            break;
                        case '02': case '12': case '22': case '32': case '42': case '52': case '62': case '72': case '82': case '92':
                            totals.total_02_92 += value;
                            break;
                        case '03': case '13': case '23': case '33': case '43': case '53': case '63': case '73': case '83': case '93':
                            totals.total_03_93 += value;
                            break;
                        case '04': case '14': case '24': case '34': case '44': case '54': case '64': case '74': case '84': case '94':
                            totals.total_04_94 += value;
                            break;
                        case '05': case '15': case '25': case '35': case '45': case '55': case '65': case '75': case '85': case '95':
                            totals.total_05_95 += value;
                            break;
                        case '06': case '16': case '26': case '36': case '46': case '56': case '66': case '76': case '86': case '96':
                            totals.total_06_96 += value;
                            break;
                        case '07': case '17': case '27': case '37': case '47': case '57': case '67': case '77': case '87': case '97':
                            totals.total_07_97 += value;
                            break;
                        case '08': case '18': case '28': case '38': case '48': case '58': case '68': case '78': case '88': case '98':
                            totals.total_08_98 += value;
                            break;
                        case '09': case '19': case '29': case '39': case '49': case '59': case '69': case '79': case '89': case '99':
                            totals.total_09_99 += value;
                            break;
                        case '10': case '20': case '30': case '40': case '50': case '60': case '70': case '80': case '90': case '100':
                            totals.total_10_100 += value;
                            break;
                    }
                }
            }
    
            // Add to AB total for 'A' and 'B' IDs
            if (['a0', 'a1', 'a2', 'a3', 'a4', 'a5', 'a6', 'a7', 'a8', 'a9'].includes(id)) totals.total_a0_a9 += value;
            if (['b0', 'b1', 'b2', 'b3', 'b4', 'b5', 'b6', 'b7', 'b8', 'b9'].includes(id)) totals.total_b0_b9 += value;
        }
    });
    totals.total_01_100 = totals.total_01_91 + totals.total_02_92 + totals.total_03_93 + totals.total_04_94 + totals.total_05_95 + totals.total_06_96 + totals.total_07_97 + totals.total_08_98 + totals.total_09_99 + totals.total_10_100 + totals.total_01_10 + totals.total_11_20 + totals.total_21_30 + totals.total_31_40 + totals.total_41_50 + totals.total_51_60 + totals.total_61_70 + totals.total_71_80 + totals.total_81_90 + totals.total_91_100;
    totals.total_AB = totals.total_a0_a9 + totals.total_b0_b9;
    totals.jantri_total = totals.total_01_100 + totals.total_AB;

    // Update the form inputs dynamically
    updateFormValues(totals, sheetType);

    function updateFormValues(totals, sheetType) {
        if (sheetType === 'S1' || sheetType === 's1') {
            // Dynamic selector updates
            document.querySelector('.swal2-popup #\\30 1-10').value =  totals[`total_01_10`];
            document.querySelector('.swal2-popup #\\31 1-20').value =  totals[`total_11_20`];
            document.querySelector('.swal2-popup #\\32 1-30').value =  totals[`total_21_30`];
            document.querySelector('.swal2-popup #\\33 1-40').value =  totals[`total_31_40`];
            document.querySelector('.swal2-popup #\\34 1-50').value =  totals[`total_41_50`];
            document.querySelector('.swal2-popup #\\35 1-60').value =  totals[`total_51_60`];
            document.querySelector('.swal2-popup #\\36 1-70').value =  totals[`total_61_70`];
            document.querySelector('.swal2-popup #\\37 1-80').value =  totals[`total_71_80`];
            document.querySelector('.swal2-popup #\\38 1-90').value =  totals[`total_81_90`];
            document.querySelector('.swal2-popup #\\39 1-100').value = totals[`total_91_100`];
        } else {
            // Non-'S1' specific updates
            document.querySelector('.swal2-popup #\\30 1-91').value = totals[`total_01_91`];
            document.querySelector('.swal2-popup #\\30 2-92').value = totals[`total_02_92`];
            document.querySelector('.swal2-popup #\\30 3-93').value = totals[`total_03_93`];
            document.querySelector('.swal2-popup #\\30 4-94').value = totals[`total_04_94`];
            document.querySelector('.swal2-popup #\\30 5-95').value = totals[`total_05_95`];
            document.querySelector('.swal2-popup #\\30 6-96').value = totals[`total_06_96`];
            document.querySelector('.swal2-popup #\\30 7-97').value = totals[`total_07_97`];
            document.querySelector('.swal2-popup #\\30 8-98').value = totals[`total_08_98`];
            document.querySelector('.swal2-popup #\\30 9-99').value = totals[`total_09_99`];
            document.querySelector('.swal2-popup #\\31 0-100').value= totals[`total_10_100`];
        }
        let total = parseInt(totals[`game_total`]) + parseInt(totals[`jantri_total`]);
        // General updates
        document.querySelector('.swal2-popup #a0-a9').value = totals[`total_a0_a9`];
        document.querySelector('.swal2-popup #b0-b9').value = totals[`total_b0_b9`];
        document.querySelector('.swal2-popup #total_bet').value = total;
        document.querySelector('.swal2-popup #jantri_total').value = totals[`jantri_total`];
        document.querySelector('.swal2-popup #AB').value = totals[`total_AB`];
        document.querySelector('.swal2-popup #\\30 1-100').value = totals[`total_01_100`];
    }
}

function save_sheet() {
    // fetch data party, game, pati, date
    var party_id = $('#party').val();
    var game_id = $('#game').val();
    var pati = $('#pati').val();
    var date = $('#date').val();
    // Submit the form data via AJAX
    $.ajax({
        type: 'POST',
        url: 'bet_insertion.php?action=save_sheet&party_id=' + party_id + '&game_id=' + game_id + '&pati=' + pati + '&date=' + date,
        data: $('#jantri_sheet').serialize(), // Serialize the form data
        success: function(response) {
            // check the response and check the error key in response
            try {
                var parsedResponse = JSON.parse(response);
                if (parsedResponse.error) {
                    // If the response contains an error, show the error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: parsedResponse.error,
                    });
                } else {
                    // If success, show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Saved!',
                        text: 'The sheet has been saved successfully.',
                    }).then(() => {
                        // Optionally, refresh the page or remove the row
                        // location.reload(); // Refresh the page
                        fetch_game_draw_data(game_id,date);
                        create_sheet("",1);
                        fetchPartyDetails(party_id, game_id, pati, date);
                        party_bet_details(party_id, game_id);
                        // make empty the input with id bet_row_input and fix the foucs on it
                        document.getElementById('bet_row_input').value = '';
                        document.getElementById('bet_row_input').focus();
                    });
                }
            } catch (e) {
                // If the response is not valid JSON, handle it as an error
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Invalid response from the server.',
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error!', 'There was an error saving the form.', 'error');
        }
    });
}

function edit_bet(crd_id){
    var date = $('#date').val(); // Get the selected date
    var game_id = $('#game').val(); // Get the selected game ID
    var user_id = $('#user_id').val();
    var party_id = $('#party').val();
    // AJAX call to fetch bet data from the database
    $.ajax({
        url: 'bet_insertion.php', // Path to your PHP script
        type: 'GET',
        data: {
            action: 'edit_bet',
            game_id: game_id,
            date: date,
            crd_id: crd_id,
            party_id: party_id,
            user_id: user_id
        }, // Include the necessary data
        success: function(response) {
            try {
                var parsedResponse = JSON.parse(response);

                // Check if the response contains an error
                if (parsedResponse.error) {
                    // If the response contains an error, show the error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: parsedResponse.error,
                    });
                } else {
                   // check the type key value 
                    if(parsedResponse.type === 'normal'){
                        // append the values in ids bet_row_input, rupees_input, number_of_bet_pairs
                        document.getElementById('bet_row_input').value = parsedResponse.bet_string;
                        document.getElementById('rupees_input').value = parsedResponse.amount;
                        document.getElementById('number_of_bet_pairs').value = parsedResponse.no_of_pair;
                        document.getElementById('action').value = 'edit';
                        document.getElementById('crd_id').value = crd_id;
                        // focus on the bet_row_input
                        document.getElementById('bet_row_input').focus();
                    }else if(parsedResponse.type === 'sheet'){
                        // Append the received HTML data to the swal popup
                        document.getElementById('action').value = 'edit';
                        document.getElementById('crd_id').value = crd_id;
                        Swal.fire({
                            title: 'Jantri',
                            html: parsedResponse.data,
                            width: 800,
                            showCloseButton: true,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Update it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Call the function to save the sheet
                                save_updated_sheet();
                            }
                        });
                    }else{
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Invalid response from the server.',
                        });
                    }
                }
            } catch (e) {
                // If the response is not valid JSON, handle it as an error
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Invalid response from the server.',
                });
            }
        },
        error: function() {
            // Handle AJAX error
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'There was an error editing the bet. Please try again.',
            });
        }
    });
}

function save_updated_sheet() {
    // on page load check the get params in URL
    var urlParams = new URLSearchParams(window.location.search);
    var g_id = urlParams.get('g_id');
    var g_name = urlParams.get('g_name');

    if (g_id) {
        // show error you can not modify the party work as the game is declared
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'You can not modify the party work as the game is declared.',
        });
        return;
    }
    // fetch data party, game, pati, date
    var party_id = $('#party').val();
    var game_id = $('#game').val();
    var pati = $('#pati').val();
    var date = $('#date').val();
    var crd_id = $('#crd_id').val();
    // Submit the form data via AJAX
    $.ajax({
        type: 'POST',
        url: 'bet_insertion.php?action=save_updated_sheet&party_id=' + party_id + '&game_id=' + game_id + '&pati=' + pati + '&date=' + date + '&crd_id=' + crd_id,
        data: $('#jantri_sheet').serialize(), // Serialize the form data
        success: function(response) {
            // check the response and check the error key in response
            try {
                var parsedResponse = JSON.parse(response);
                if (parsedResponse.error) {
                    // If the response contains an error, show the error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: parsedResponse.error,
                    });
                } else {
                    // If success, show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'The sheet has been updated successfully.',
                    }).then(() => {
                        // Optionally, refresh the page or remove the row
                        // location.reload(); // Refresh the page
                        fetch_game_draw_data(game_id,date);
                        create_sheet("",1);
                        fetchPartyDetails(party_id, game_id, pati, date);
                        party_bet_details(party_id, game_id);
                        $('#action').val('');
                        $('#crd_id').val('');
                        // make empty the input with id bet_row_input and fix the foucs on it
                        document.getElementById('bet_row_input').value = '';
                        document.getElementById('bet_row_input').focus();
                    });
                }
            } catch (e) {
                // If the response is not valid JSON, handle it as an error
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Invalid response from the server.',
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error!', 'There was an error saving the form.', 'error');
        }
    });
}

function insert_bet_data(){
    // ajax request to insert the bet data
    $.ajax({
        type: 'POST',
        url: 'insert_data_cbd_table.php?action=insert_bet_data',
        success: function(response) {
            // check the response and check the error key in response
            try {
                update_virtual_box();
                // If success, show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Inserted!',
                    text: 'The basket is refreshed successfully.',
                }).then(() => {
                    var sheet_type = $('#sheetDropdown').val(); // Get the selected sheet type
                    create_sheet("",sheet_type);
                });
            } catch (e) {
                // If the response is not valid JSON, handle it as an error
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Invalid response from the server.',
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error!', 'There was an error saving the form.', 'error');
        }
    });
}

function edit_bet_data(){
    // ajax request to insert the bet data
    $.ajax({
        type: 'POST',
        url: 'insert_data_cbd_table.php?action=edit_bet_data',
        success: function(response) {
            // check the response and check the error key in response
            try {
                var parsedResponse = JSON.parse(response);
                if (parsedResponse.error) {
                    // If the response contains an error, show the error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: parsedResponse.error,
                    });
                } else {
                    // If success, show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Inserted!',
                        text: 'The bet data inserted into the main sheet.',
                    }).then(() => {
                        var sheet_type = $('#sheetDropdown').val(); // Get the selected sheet type
                        create_sheet("",sheet_type);
                    });
                }
            } catch (e) {
                // If the response is not valid JSON, handle it as an error
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Invalid response from the server.',
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire('Error!', 'There was an error saving the form.', 'error');
        }
    });
}

function entry_checker() {
    // AJAX request to check the virtual box
    $.ajax({
        type: 'POST',
        url: 'insert_data_cbd_table.php?action=entry_checker',
        success: function(response) {
            try {
                var parsedResponse = JSON.parse(response);
                if (parsedResponse.error) {
                    // Show error message if the virtual box is not empty
                    Swal.fire({
                        icon: 'error',
                        title: 'Virtual Box is not Empty!',
                        text: 'There are some entries in the virtual box. Please hit the empty virtual box buttons.',
                    }).then(() => {
                        // Perform subsequent AJAX calls
                        empty_virtual_box();
                    });
                } else {
                    // Return success (or handle accordingly)
                    return 1;
                }
            } catch (e) {
                // Handle invalid JSON response
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Invalid response from the server.',
                });
            }
        },
        error: function(xhr, status, error) {
            // Handle AJAX error
            Swal.fire('Error!', 'There was an error checking the virtual box.', 'error');
        }
    });
}

// Function to empty the virtual box
function empty_virtual_box() {
    $.ajax({
        type: 'POST',
        url: 'cron_auto_insert.php',
        success: function() {
            update_virtual_box();
        },
        error: function() {
            Swal.fire('Error!', 'Failed to empty the virtual box.', 'error');
        }
    });
}

// Function to update the virtual box
function update_virtual_box() {
    $.ajax({
        type: 'POST',
        url: 'cron_auto_update.php',
        success: function() {
            var sheet_type = $('#sheetDropdown').val(); // Get the selected sheet type
            create_sheet("", sheet_type);
        },
        error: function() {
            Swal.fire('Error!', 'Failed to update the virtual box.', 'error');
        }
    });
}

function checkAndTrigger() {
    // Get the values of game ID and date
    var game_id = $('#game').val();
    var date = $('#date').val();
    // Check if both values are available
    if (game_id && date) {
        var sheet_type = $('#sheetDropdown').val(); // Get the selected sheet type
        create_sheet("",sheet_type);
    }
}

// Call the checkAndTrigger function every 1 minute (60000 ms)
// setInterval(checkAndTrigger, 60000);
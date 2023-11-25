document.addEventListener("DOMContentLoaded", function () {
    // Get the lookup button and add a click event listener
    document.getElementById("lookup").addEventListener("click", function () {
        // Fetch data from the server using AJAX (you may use Fetch API or other libraries like jQuery)
        fetch("data.php")
            .then(response => response.json()) // Assuming the server sends JSON data
            .then(data => displayResults(data))
            .catch(error => console.error("Error fetching data:", error));
    });

    // Function to display results in the result div
    function displayResults(data) {
        var resultDiv = document.getElementById("result");
        resultDiv.innerHTML = "<ul>";

        // Loop through the data and create list items
        data.forEach(function (item) {
            var listItem = document.createElement("li");
            listItem.textContent = item.name + ' is ruled by ' + item.head_of_state;
            resultDiv.appendChild(listItem);
        });

        resultDiv.innerHTML += "</ul>";
    }
});
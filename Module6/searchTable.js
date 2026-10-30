
// Get the search box and table
const searchInput = document.getElementById("search");
const tableBody = document.querySelector("tbody");

// Run search when the user types
searchInput.addEventListener("input", function() {
    const searchText = searchInput.value.toLowerCase().trim();

    // Reset the table when search is empty
    if (searchText === "") {
        window.location.reload();
        return;
    }

    // Search through all customer records
    const results = customers.filter(function(customer) {
        return Object.values(customer).some(function(value) {
            return String(value).toLowerCase().includes(searchText);
        });
    });

    // Clear the current table
    tableBody.innerHTML = "";

    // Display matching customers
    results.forEach(function(customer) {
        const row = document.createElement("tr");

        // Add customer information to the row
        [
            customer.id,
            customer.first,
            customer.last,
            customer.product,
            "$" + Number(customer.price).toFixed(2)
        ].forEach(function(value) {
            const cell = document.createElement("td");
            cell.textContent = value;
            row.appendChild(cell);
        });

        tableBody.appendChild(row);
    });
});

// Get comparisons
const customer1 = document.getElementById("customer1");
const customer2 = document.getElementById("customer2");
const compareBtn = document.getElementById("compareBtn");
const compareResult = document.getElementById("compareResult");

// Add customers to both dropdowns
customers.forEach(function(customer) {
    const name = customer.first + " " + customer.last;

    customer1.add(new Option(name, customer.id));
    customer2.add(new Option(name, customer.id));
});

// Compare customer spending
compareBtn.addEventListener("click", function() {
    const first = customers.find(c => c.id == customer1.value);
    const second = customers.find(c => c.id == customer2.value);

    if (!first || !second || first.id === second.id) {
        compareResult.textContent = "Please select two different customers.";
        return;
    }

    const difference = Math.abs(first.price - second.price);

    if (first.price === second.price) {
        compareResult.textContent = "Both customers spent the same amount.";
    } else {
        const higher = first.price > second.price ? first : second;
        const lower = first.price > second.price ? second : first;

        compareResult.textContent =
            higher.first + " " + higher.last +
            " spent $" + difference.toFixed(2) +
            " more than " + lower.first + " " + lower.last + ".";
    }
});


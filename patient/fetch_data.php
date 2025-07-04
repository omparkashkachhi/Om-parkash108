<form class="input-group mb-4">
    <input type="text" id="search" class="form-control" placeholder="Search hospital by name...">
</form>

<div id="results" class="row"></div>

<script>
    document.getElementById("search").addEventListener("keyup", function () {
        let query = this.value;
        let xhr = new XMLHttpRequest();
        xhr.open("GET", "fetch_data.php?search=" + query, true);
        xhr.onload = function () {
            if (this.status === 200) {
                document.getElementById("results").innerHTML = this.responseText;
            }
        };
        xhr.send();
    });
</script>
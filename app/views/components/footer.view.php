</section>
<section class="my-5"></section>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    function containsString(mainString, searchString) {
        // Escape special characters in the search string
        const escapedSearchString = searchString.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

        // Create a regex pattern with the escaped search string
        const pattern = new RegExp(escapedSearchString);

        // Test if the main string contains the search string
        return pattern.test(mainString);
    }
    document.addEventListener('DOMContentLoaded', function() {
        function check_session() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '<?= ROOT ?>/ajax/check_if_logged_in', true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var data = xhr.response;
                    let obj = JSON.parse(data);
                    if (!obj) {
                        const currentUrl = window.location.href;
                        if (!containsString(currentUrl, 'login')) {
                            alert('Сеанс завершен! ');
                            clearInterval(intervalId)
                        }

                        // window.location.href = 'login.php';
                    }
                }
            };

            xhr.send();
        }

        // Call check_session function every 10 seconds
        // var intervalId = setInterval(function() {
        //     check_session();
        // }, 1000); // 10000 means 10 seconds
    });
</script>
</body>


</html>
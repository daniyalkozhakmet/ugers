<ul class="nav nav-tabs w-100 container my-2">
    <li class="nav-item">
        <a class="nav-link " id="get_users" href=" <?= ROOT . '/admin/get_users' ?>">Пользователи</a>
    </li>
    <li class="nav-item">
        <a class="nav-link " id="get_my_claims" href=" <?= ROOT . '/claim/get_my_claims' ?>">Заявки</a>
    </li>
    <li class="nav-item">
        <a class="nav-link " id="get_my_deleted_claims" href=" <?= ROOT . '/claim/get_my_deleted_claims' ?>">Удаленные заявки</a>
    </li>
</ul>
<script>
    function containsString(mainString, searchString) {
        // Escape special characters in the search string
        const escapedSearchString = searchString.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

        // Create a regex pattern with the escaped search string
        const pattern = new RegExp(escapedSearchString);

        // Test if the main string contains the search string
        return pattern.test(mainString);
    }
    const currentUrl = window.location.href;
    const links = ['get_users', 'get_my_claims', 'get_my_deleted_claims']
    links.forEach((link) => {
        if (containsString(currentUrl, link)) {
            document.querySelector(`#${link}`).classList.add('active');
        }
    })
</script>
<ul class="nav nav-tabs w-100 container my-2">
    <li class="nav-item">
        <a class="nav-link " href=" <?= ROOT . '/admin' ?>">Users</a>
    </li>
    <li class="nav-item">
        <a class="nav-link " href=" <?= ROOT . '/claim' ?>">Claims</a>
    </li>
</ul>
<script>
    const currentUrl = window.location.href;
    const myArray = currentUrl.split("/");
    const links = ['admin', 'claim']
    links.forEach((link) => {

        if (myArray.includes(link)) {

            const anchorTag = document.querySelector('a[href*="' + link + '"]');

            anchorTag.classList.add('active')
        }
    })
</script>
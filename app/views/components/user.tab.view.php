<ul class="nav nav-tabs w-100 container my-4">
    <li class="nav-item">
        <a class="nav-link " id="create" href=" <?= ROOT . '/claim/create' ?>">Create</a>
    </li>
    <li class="nav-item">
        <a class="nav-link " id="get_my_claims" href=" <?= ROOT . '/claim/get_my_claims' ?>"><?= $_SESSION['USER']->username ?> Claims</a>
    </li>
</ul>
<script>
    console.log('Hello')
    const currentUrl = window.location.href;
    const myArray = currentUrl.split("/");
    const links = ['create', 'get_my_claims']
    links.forEach((link) => {

        if (myArray.includes(link)) {
            document.querySelector(`#${link}`).classList.add('active');
        }
    })
</script>
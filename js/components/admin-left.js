const PAGE_TITLE = document.title;
const ADMIN_LEFT_TEMPLATE = document.createElement('template');

ADMIN_LEFT_TEMPLATE.innerHTML = 
`
<div class="admin-dashboard__left">
    <div class="admin-dashboard__left__title">
        <h1>Admin Dashboard | The Mobile Hour</h1>
    </div>
    <h2>Panels</h2>
    <button class="button--standard --panel-active">Products</button>
    <button class="button--standard">Users</button>
    <button class="button--standard">Changelogs</button>
</div>
`;

document.body.appendChild(ADMIN_LEFT_TEMPLATE);
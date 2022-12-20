const PAGE_TITLE = document.title;
const HEADER_TEMPLATE = document.createElement('template');
const FILE_DEPTH = (PAGE_TITLE === "The Mobile Hour") ? "." : "..";

if(window.innerWidth < 650) {
  var displayStyle = "none";
} else {
  var displayStyle = "flex";
}

HEADER_TEMPLATE.innerHTML =
`
<header>
    <div class="header__left">
      <img class="logo" src="${FILE_DEPTH}/images/the-mobile-hour/logo.png" onclick="window.location.href='${FILE_DEPTH}/index.php'">
      <nav id='nav-menu' style='display: ${displayStyle}'>
        <ul>
          <li id="navlink__home" class=""><a href="${FILE_DEPTH}/index.php">Home</a></li>
          <li id="navlink__products" class=""><a href="${FILE_DEPTH}/pages/products.php">Products</a></li>
          <li id="navlink__about" class=""><a href="${FILE_DEPTH}/pages/about.html">About</a></li>
          <li id="navlink__contact" class=""><a href="${FILE_DEPTH}/pages/contact.php">Contact</a></li>
        </ul>
      </nav>
    </div>
    <div class="headerButtons">
      <button onclick="window.location.href='${FILE_DEPTH}/pages/under-construction.php'">♡</button>
      <img src="${FILE_DEPTH}/images/icons/cart.png" onclick="window.location.href='${FILE_DEPTH}/pages/cart.php'"></img>
      <svg onclick="window.location.href='${FILE_DEPTH}/pages/under-construction.php'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 129 129" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 129 129"><g><g><path d="m64.3,71.6c18,0 32.6-14.6 32.6-32.6s-14.6-32.5-32.6-32.5-32.6,14.6-32.6,32.5 14.6,32.6 32.6,32.6zm0-56.6c13.2,0 24,10.8 24,24s-10.8,24-24,24-24-10.8-24-24 10.8-24 24-24z"></path><path d="m7.9,122.5h113.2c2.4,0 4.3-1.9 4.3-4.3 0-22.5-18.3-40.9-40.9-40.9h-40c-22.5,0-40.9,18.3-40.9,40.9-1.33227e-15,2.4 1.9,4.3 4.3,4.3zm36.6-36.6h40c16.4,0 29.9,12.2 32,28h-104c2.1-15.7 15.6-28 32-28z"></path></g></g></svg>
      <button id='nav-button'><i class="fa-solid fa-bars"></i></button>
    </div>
</header>
`;

document.body.appendChild(HEADER_TEMPLATE.content);
let navActiveClass = "link--active";

if(PAGE_TITLE === "The Mobile Hour") document.getElementById("navlink__home").classList = navActiveClass;
else if (PAGE_TITLE.endsWith("Products | The Mobile Hour")) document.getElementById("navlink__products").classList = navActiveClass;
else if (PAGE_TITLE === "About | The Mobile Hour") document.getElementById("navlink__about").classList = navActiveClass;
else if (PAGE_TITLE === "Contact | The Mobile Hour") document.getElementById("navlink__contact").classList = navActiveClass;

let navButtonEl = document.getElementById("nav-button");
let navMenuEl = document.getElementById("nav-menu");

navButtonEl.addEventListener("click", function() { 
    if(navMenuEl.style.display === "none") {
        navMenuEl.style.display = "flex";
        navButtonEl.innerHTML=`<i class="fa-solid fa-xmark"></i>`
    }
    
    else {
        navMenuEl.style.display = "none";
        navButtonEl.innerHTML=`<i class="fa-solid fa-bars"></i>`
    }
});
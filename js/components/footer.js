const FOOTER_TEMPLATE = document.createElement('template');

FOOTER_TEMPLATE.innerHTML =
`
<footer>
    <div class="footer__container">
        <div class="footer__contact">
            <h4>CONTACT</h4>
            <p>123 Phone Street</p>
            <p>Brisbane City, 4000</p>
            <p>Queensland, Australia</p>
            <br></br>
            <p>Phone: 07 1234 5678</p>
            <p>Email: admin@the-mobile-hour.com.au</p>
        </div>

        <div class="footer_sitemap">
            <h4>MENU</h4>
            <ul>
                <li><a href='${FILE_DEPTH}/index.php'>Home</a></li>
                <li><a href='${FILE_DEPTH}/pages/products.php'>Products</a></li>
                <li><a href='${FILE_DEPTH}/pages/about.html'>About</a></li>
                <li><a href='${FILE_DEPTH}/pages/contact.php'>Contact</a></li>
                <li><a href='${FILE_DEPTH}/pages/admin-login.php'>Admin Login</a></li>
            </ul>
        </div>

        <div class="footer_socialmedia">
            <h4>SOCIAL MEDIA</h4>
            <ul>
                <li><a>Facebook</a></li>
                <li><a>Twitter</a></li>
                <li><a>Instagram</a></li>
            </ul>
        </div>
    </div>
</footer>
`;

document.body.appendChild(FOOTER_TEMPLATE.content);
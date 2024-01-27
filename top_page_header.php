<nav class="nav">
    <div class='logo'><a href="index.php"><img src="img/logo.png" alt='Cafe'></a></div>
    <div class='g_nav'>
        <div class='menu _click' id='intro' v-on="click: toIntro" v-transition>はじめに</div>
        <div class='menu _click' id='experience' v-on="click: toExp" v-transition>体験</div>
        <div class='menu'><a href="contact.php">お問い合わせ</a></div>
    </div>
    <div class='sign'>
        <!-- <div class='signup'>登録</div> -->
        <div class='signin _click' v-on="click: openModal">サインイン</div>
        <div class='sp _click' v-on="click: spMenu=!spMenu"><img src="img/menu.png" alt="スマホメニュー"></div>
        <div class='sp_nav' v-class="sp_nav_motion: position > 50" v-if="spMenu">
            <div class='sp_signin _click' v-on="click: openModal">サインイン</div>
            <div class='sp_menu _click' v-on="click: toIntro" v-transition>はじめに</div>
            <div class='sp_menu _click' v-on="click: toExp" v-transition>体験</div>
            <div class='sp_menu'><a href="contact.php">お問い合わせ</a></div>
        </div>
    </div>
</nav>
<open-modal v-show="showContent" v-on="click: closeModal"></open-modal>
        <div id="overlay"></div>
        <div class="signin_box">
            <h2>ログイン</h2>
            <form action="" method="post">
                <dl>
                    <dd><input type="text" name="name" placeholder="メールアドレス"></dd>
                    <dd><input type="password" name="pass" placeholder="パスワード"></dd>
                    <dd><button type="submit">送　信</button></dd>
                </dl>
                <dl class="sns">
                    <dd><button name="twitter"><img src="img/twitter.png"></button></dd>
                    <dd><button name="facebook"><img src="img/fb.png"></button></dd>
                    <dd><button name="google"><img src="img/google.png"></button></dd>
                    <dd><button name="apple"><img src="img/apple.png"></button></dd>
                </dl>
            </form>
        </div>
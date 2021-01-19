
   <!-- sidebar -->
   <nav class="sidebar">
    <div class="sidebar-header">
        <a href="index.php" class="sidebar-brand"><br />
            <h6><img src="<?php echo $baseUrl; ?>assets/images/logo.png" class="logo-top">Sneaks and Laces</h6>
            Sneak<span>Laces</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <?php
            $sessionid = $_SESSION["user_id"];
            
            $conn = mysqli_connect($db_host, $db_username, $db_password, $db_tablename);

            $role = mysqli_query($conn, "SELECT * FROM roles where user_id = '".$sessionid."'");
            $checkrole = mysqli_fetch_array($role);

            $menu = mysqli_query($conn, "SELECT * FROM menus ORDER BY sort ASC");

            if (mysqli_num_rows($menu) > 0) {
                while ($row = mysqli_fetch_array($menu)) {
                    if ($checkrole[$row['role']] == 'true') {
                    $submenu = mysqli_query($conn, "SELECT * FROM sub_menus where menu_id = '" . $row['menu_id'] . "'");
                    $set = mysqli_num_rows($submenu) > 0;

                    if (!$set) { ?>
                    <li class="nav-item">
                        <a href="<?php echo $baseUrl; ?><?php echo $row['url']; ?>" class="nav-link">
                            <i class="link-icon" data-feather="<?php echo $row['icon']; ?>"></i>
                            <span class="link-title"><?php echo $row['description']; ?></span>
                        </a>
                    </li>
                    <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#<?php echo $row['role']; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $row['role']; ?>">
                            <i class="link-icon" data-feather="<?php echo $row['icon']; ?>"></i>
                            <span class="link-title"><?php echo $row['description']; ?></span>
                            <i class="link-arrow" data-feather="chevron-down"></i>
                        </a>
                        <div class="collapse" id="<?php echo $row['role']; ?>">
                            <ul class="nav sub-menu">
                                <?php
                                    while ($subrow = mysqli_fetch_array($submenu)) {
                                        if (@$checkrole[($subrow['role'])] == 'true') {?>
                                        <li class="nav-item">
                                            <a href="<?php echo $subrow['url'] ?>" class="nav-link"><?php echo $subrow['description'] ?></a>
                                        </li>
                                <?php }} ?>
                            </ul>
                        </div>
                    </li>
            <?php }}}} ?>
        </ul>
    </div>
</nav>
<!-- side-bar -->

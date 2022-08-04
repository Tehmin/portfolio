<?php
require_once 'parts/header.php';
?>

<main>
    <section id="intro" class="row">
      <div class="intro_overlay"></div>
      <div class="wrapper intro_content">
          <div>
              <h5>WELCOME TO MY WORLD</h5>
              <h1 class="title">Hi, I’m <span>Mina</span></h1>
              <div>
                  <div class="typing_block flex justify_center">
                      <span>a</span>
                      <div class="typing"> Full-Stack Web Developer</div>
                  </div>
              </div>
              <a class="button scroll_button tr3" href="#about">More About Me</a>
          </div>
      </div>
    </section>
    <section id="about" class="row">
    <div class="wrapper">
        <div class="intro_title">
            <h5>About</h5>
            <h2>Let me introduce myself.</h2>
        </div>
        <div class="about_text_block">
            <p>I create professional websites - from business cards to personal projects. If you have a project that you want to get started or think you need my help with something, then get in touch.</p>
        </div>
        <div class="skills_block">
            <h5>My Skills</h5>
            <div class="flex justify_center">
                <ul class="skill_bars flex justify_center flex_wrap">
                    <?php
                        $sql_select_skills = "SELECT skill, percent FROM skills";
                        $result = $conn->query($sql_select_skills);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                    <li>
                                        <div class='progress percent<?= $row["percent"] ?>'>
                                            <span><?= $row["percent"]?>%</span>
                                        </div>
                                        <strong><?= $row["skill"] ?></strong>
                                    </li>
                          <?php  }
                        }
                        else {
                            echo "0 results";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    </section>
    <section id="portfolio" class="row">
    <div class="wrapper">
        <div class="intro_title">
            <h5>Portfolio</h5>
            <h2>Check Out Some of My Works.</h2>
        </div>
        <div class="about_text_block">
            <p>If you want to have a website, I will gladly bring to life any of your ideas.</p>
        </div>
        <div class="portfolio_block">
            <div class="reveal flex justify_center flex_wrap">
                <?php
                    $sql_select = "SELECT image, type, title, url FROM portfolio";
                    $result = $conn->query($sql_select);
                    $target_dir = "uploads/";
                    
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $img_src = $target_dir . $row["image"];
                            ?>
                              <div class='portfolio_item'>
                                    <div class='inner'>
                                        <div>
                                            <a href='<?=$row["url"] ?>' target='_blank'>
                                                <img src='<?= $img_src ?>' alt='Personal Portfolio Images'>
                                            </a>
                                        </div>
                                        <div class='portfolio_content'>
                                            <h5><?= $row["type"]?></h5>
                                            <h3>
                                                <a href='<?= $row["url"] ?>' target='_blank' class='tr3'>
                                                <?= $row["title"] ?>
                                                    <i class='arrow_up_right'></i>
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                    }
                    else {
                        echo "0 results";
                    }
                ?>
            </div>
        </div>
    </section>
    <section id="services" class="row">
    <div class="intro_overlay"></div>
    <div class="wrapper intro_content">
        <div class="intro_title">
            <h5>Services</h5>
            <h2>What Can I Do For You?</h2>
        </div>
        <div class="flex services_block justify_center">
            <div class="service_item">
                <span class="service_icon">
                    <i class="icon_window"></i>
                </span>
                <div class="service_content">
                    <h3>Web Development</h3>
                    <p class="desc">
                        Development of an adaptive website that provides the correct display on various devices and daily site maintenance.
                    </p>
                </div>
            </div>
            <div class="service_item">
                <span class="service_icon">
                    <i class="icon_cog"></i>
                </span>
                <div class="service_content">
                    <h3>WordPress / CMS website</h3>
                    <p class="desc">
                        Filling the site with content text, graphic information. Installing and configuring plugins.
                    </p>
                </div>
            </div>
            <div class="service_item">
                <span class="service_icon">
                    <i class="icon_pencil"></i>
                </span>
                <div class="service_content">
                    <h3>Photoshop</h3>
                    <p class="desc">
                        Image processing with Photoshop. Аdjusting and retouching images, transforming, using effects.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </section>
    <section id="contact" class="row">
    <div id="contact_info" class="row flex justify_center">
        <div class="contact_item">
            <span class="contact_icon">
                <i class="icon_map_marker"></i>
            </span>
            <div class="contact_content">
                <h3>WHERE TO FIND ME</h3>
                <p class="desc">
                    <a href="https://goo.gl/maps/sYaWMa5A5CQEyAzd9" target="_blank">
                        Armenia
                    </a>
                </p>
            </div>
        </div>
        <div class="contact_item">
            <span class="contact_icon">
                <i class="icon_envelope"></i>
            </span>
            <div class="contact_content">
                <h3>EMAIL ME AT</h3>
                <p class="desc">
                    <a href="mailto:vardumyan.tehmina@gmail.com" target="_blank">
                        vardumyan.tehmina@gmail.com
                    </a>
                </p>
            </div>
        </div>
        <div class="contact_item">
            <span class="contact_icon">
                <i class="icon_linkedin"></i>
            </span>
            <div class="contact_content">
                <h3>FIND ME AT</h3>
                <p class="desc">
                    <a href="https://www.linkedin.com/in/tehmina-vardumyan-083b85238/" target="_blank">
                        Linkedin
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="contact_form_row">
        <div class="wrapper">
            <div class="row contact_form">
                <div class="intro_title">
                    <h5>Contact</h5>
                    <h2>I'd Love To Hear From You.</h2>
                </div>
                <div>
                    <?php require_once 'parts/contact.php'; ?>
                </div>
            </div>
        </div>
    </div>
    </section>
</main>

<?php
require_once 'parts/footer.php';

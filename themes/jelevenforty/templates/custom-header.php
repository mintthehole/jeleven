<div id="header">
  <div id="logo-floater">
  <?php if ($logo || $site_title): ?>
    <?php if ($title): ?>
      <div id="branding"><strong><a href="<?php print $front_page ?>">
      <?php if ($logo): ?>
        <img src="<?php print $logo ?>" alt="<?php print $site_name_and_slogan ?>" title="<?php print $site_name_and_slogan ?>" id="logo" />
      <?php endif; ?>
      <?php print $site_html ?>
      </a></strong></div>
    <?php else: /* Use h1 when the content title is empty */ ?>
      <h1 id="branding"><a href="<?php print $front_page ?>">
      <?php if ($logo): ?>
        <img src="<?php print $logo ?>" alt="<?php print $site_name_and_slogan ?>" title="<?php print $site_name_and_slogan ?>" id="logo" />
      <?php endif; ?>
      <?php print $site_html ?>
      </a></h1>
  <?php endif; ?>
  <?php endif; ?>
  </div>

  <?php if ($primary_nav): print $primary_nav; endif; ?>
  <?php if ($secondary_nav): print $secondary_nav; endif; ?>
</div> <!-- /#header -->
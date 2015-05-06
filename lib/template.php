<!doctype html>
<html>
  <head>
  <meta charset='utf-8'>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width">

  <title><?php echo ucwords($this->docs_foldername) ?> Documentation</title>

  <!-- Flatdoc -->
  <script src=<?php echo base_url('assets/support/vendor/jquery.js') ?>></script>
  <script src=<?php echo base_url('assets/legacy.js') ?>></script>
  <script src=<?php echo base_url('assets/flatdoc.js?94850') ?>></script>

  <!-- Flatdoc theme -->
  <link href=<?php echo base_url('assets/theme-white/style.css?94850') ?> rel='stylesheet'>
  <script src=<?php echo base_url('assets/theme-white/script.js?94850') ?>></script>
  <link  href=<?php echo base_url('assets/support/theme.css?94850') ?> rel='stylesheet'>
  <script src=<?php echo base_url('assets/support/theme.js?94850') ?>></script>

  <!-- Initializer -->
  <script>
    var docs_file = '<?php echo 'http://docmapper.dev/'.$this->docs_filepath ?>'
    Flatdoc.run({
      fetcher: Flatdoc.file(docs_file)
    });
  </script>

</head>

<body role='flatdoc'>

  <div class='header'>
    <div class='left'>
      <h1><?php echo ucwords($this->docs_foldername) ?> Documentation</h1>
      <ul>
        <!-- foreach file in view docs generate link -->
        <?php foreach(get_links($this->docs_foldername) as $link): ?>
          <li>
            <a href="<?php echo base_url($link['href'])?>"><?php echo $link['title'] ?></a>
          </li>
        <?php endforeach ?>
      </ul>
    </div>
    <div class='right'>
      <!-- GitHub buttons: see http://ghbtns.com -->
      <!-- <iframe src="http://ghbtns.com/github-btn.html?user=USER&amp;repo=REPO&amp;type=watch&amp;count=true" allowtransparency="true" frameborder="0" scrolling="0" width="110" height="20"></iframe> -->
    </div>
  </div>

  <div class='content-root'>
    <div class='menubar'>
      <div class='menu section' role='flatdoc-menu'></div>
    </div>
    <div role='flatdoc-content' class='content'></div>
  </div>

</body>
</html>
<?php defined("SYSPATH") or die("No direct script access.") ?>
<div id="gAlbumHeader">
  <div id="gAlbumHeaderButtons">
    <?= $theme->dynamic_top() ?>
  </div>
  <h1><?= html::clean($title) ?></h1>
</div>
<? $children_all = $tag->items();
     $theme->pagination = new Pagination();
		$theme->pagination->initialize(array("query_string" => "page","total_items" => $children_count,"items_per_page" => $page_size,"style" => "classic"));
	$children_offset = ($theme->pagination->current_page -1) * $page_size ; ?>


<ul id="gAlbumGrid">
  <? for($i=0;$i<$children_offset;$i++): ?>
	  <? $child = $children_all[$i] ?>
	  <? if ($child->is_photo()): ?>
		<? $fancymodule = ""; ?>
		<? if (module::is_active("exif")){$fancymodule .= "exif::" . url::site("exif/show/{$child->id}") . ";;";} ?>
		<? if (module::is_active("comment") && module::is_active("comment_3nids")){$fancymodule .= "comment::" . url::site("comments_3nids?item_id={$child->id}") . ";;comment_count::" . comment_3nids::count($child) . ";;" ;} ?>
		<a href="<?=$child->file_url()?>" rel="fancygroup" class="fancyclass" title="<?= $child->parent()->title ?>, <?=$child->parent()->description?>" name="<?=$fancymodule  ?>"></a>
	  <? endif	 ?>
<? endfor ?>

  <? foreach ($children as $i => $child): ?>
  
  <!--<li class="gItem <?= $child->is_album() ? "gAlbum" : "" ?>">!-->
  <li id="gItemId-<?= $child->id ?>" class="gItem gAlbum">
    <?= $theme->thumb_top($child) ?>
    <? if (!($child->is_album())): ?>
    <? if ($child->is_photo()): ?>
		<? $fancymodule = ""; ?>
		<? if (module::is_active("exif")){$fancymodule .= "exif::" . url::site("exif/show/{$child->id}") . ";;";} ?>
		<? if (module::is_active("comment") && module::is_active("comment_3nids")){$fancymodule .= "comment::" . url::site("comments_3nids?item_id={$child->id}") . ";;comment_count::" . comment_3nids::count($child) . ";;" ;} ?>
		<a href="<?=$child->file_url()?>" rel="fancygroup" class="fancyclass" title="<?= $child->parent()->title ?>, <?=$child->parent()->description?>" name="<?=$fancymodule  ?>">
    <? else: ?>
      <a href="<?= $child->url() ?>">
    <? endif ?>
	      <img id="gPhotoId-<?= $child->id ?>" class="gThumbnail"
		   alt="photo" src="<?= $child->thumb_url() ?>"
		   width="<?= $child->thumb_width ?>"
		   height="<?= $child->thumb_height ?>" />
       </a>
    <a href="<?= $child->parent()->url() ?>?show=<?= $child->id?>"><h2><span></span><?= $child->parent()->title ?></h2></a>
     <? if ($user->admin): ?>
	<a href="<?=$child->url()?>">view</a>
     <? endif ?>
   <? else: ?>
           <a href="<?= $child->url() ?>">
	      <img id="gPhotoId-<?= $child->id ?>" class="gThumbnail"
		   alt="photo" src="<?= $child->thumb_url() ?>"
		   width="<?= $child->thumb_width ?>"
		   height="<?= $child->thumb_height ?>" />
                <h2><span></span><?= html::clean($child->title) ?></h2>
	 </a>   
 <? endif ?>
<?= $theme->thumb_bottom($child) ?>
<?= $theme->context_menu($child, "#gItemId-{$child->id} .gThumbnail") ?>
    <? if ($child->is_photo() && module::is_active("comment") && module::is_active("comment_3nids")) :?>
	<ul class="gMetadata">
		<li><a href="<?=url::site("comments_3nids?item_id={$child->id}")?>" class="iframe fancyclass"><?=comment_3nids::count($child) ?> <?=t("comments")?></a></li>   
	</ul>
     <? endif ?>
  </li>
  <? endforeach ?>
<? for($i=$children_offset+$page_size;$i<$children_count;$i++): ?>
	  <? $child = $children_all[$i] ?>
	  <? if ($child->is_photo()): ?>
		<? $fancymodule = ""; ?>
		<? if (module::is_active("exif")){$fancymodule .= "exif::" . url::site("exif/show/{$child->id}") . ";;";} ?>
		<? if (module::is_active("comment") && module::is_active("comment_3nids")){$fancymodule .= "comment::" . url::site("comments_3nids?item_id={$child->id}") . ";;comment_count::" . comment_3nids::count($child) . ";;" ;} ?>
		<a href="<?=$child->file_url()?>" rel="fancygroup" class="fancyclass" title="<?= $child->parent()->title ?>, <?=$child->parent()->description?>" name="<?=$fancymodule  ?>"></a>
	  <? endif	 ?>
<? endfor ?>
</ul>
<?= $theme->dynamic_bottom() ?>

<?= $theme->pager() ?>

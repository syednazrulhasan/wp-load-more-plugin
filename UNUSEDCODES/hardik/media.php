<?php
/**
 * Template Name: Media
 * The template used for displaying fullwidth page content in Publications page
 *
 * @package hitmag
 */

get_header(); ?>

<style>
	@media(max-width: 767.98px){
	.featured-sec .event-bnr {
		top: auto;
		bottom: 20%;
	}	
	.featured-sec .post-bnr-inner h2 {
		font-size: 30px;
		line-height: initial;
		width: 100%;
	}
	.featured-sec .post-bnr-inner {
		width: 100%;
	}
}


#mediaposts .loader {
  display: block;
  margin: 0 auto;
}
.center-btn {
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>

<?php

$featured_section = get_field('featured_section');
$cta_section = get_field('cta_section');

?>
<?php if($featured_section['title']){ ?>
	<section class="featured-sec">
		<div class="container event-bnr">
			<div class="row">
				<div class="post-bnr-inner">
					<p class="bg-cream featured-text"><?php echo $featured_section['featured_text']; ?></p>
					<h2 class="white"><?php echo $featured_section['title']; ?></h2>
					<?php if($featured_section['button_text']){ ?>
						<a class="btn-link" href="<?php echo $featured_section['button_link']['url']; ?>" target="<?php echo $featured_section['button_link']['target']; ?>"><?php echo $featured_section['button_text']; ?></a>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="featured-img">
			<img src="<?php echo $featured_section['background_image_for_desktop']['url']; ?>" alt="<?php echo $featured_section['background_image_for_desktop']['alt']; ?>" class="desktop">
			<img src="<?php echo $featured_section['background_image_for_mobile']['url']; ?>" alt="<?php echo $featured_section['background_image_for_mobile']['alt']; ?>" class="mobile">
		</div>
	</section>
<?php } ?>

<section class="related-posts">
	<div class="container">
		<div class="row">
			<div class="all-cat">
				<?php 
					$terms = get_terms([
					    'taxonomy' => 'media_category',
					]);
					$regions = get_terms([
						'taxonomy'	=>	'media_region',
					]);
					$years = get_terms([
						'taxonomy'	=>	'media_year',
					]);
				?>
				<ul class="cat-list">
					<li data-termslug="all" class="bg-cream gradient-1 white filteritem active"><a>All</a></li>
					<?php foreach ($terms as $term){ ?>
					  	<li data-termslug="<?php echo $term->slug; ?>" class="bg-cream dark-blue filteritem"><a><?php echo $term->name; ?></a></li>
					<?php } ?>
				</ul>
				<div class="filter-main">
					<div class="filter-wrapper">
						<img src="/wp-content/uploads/2023/12/filter.png" alt="Filter Icon">
						<p class="navy-blue">Filter</p>
					</div>
					<div class="filter-dropdown">
						<select id="selectregion">
							<option value="region">Region</option>
							<?php foreach ($regions as $region) { ?>
								<option value="<?php echo $region->slug; ?>"><?php echo $region->name; ?></option>
							<?php } ?>
						</select>
						<select id="selectyear">
							<option value="year">Year</option>
							<?php foreach ($years as $year) { ?>
								<option value="<?php echo $year->slug; ?>"><?php echo $year->name; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>
			<div class="posts-slider myposts" id="mediaposts">
					
			</div>
			<input type="hidden" name="pageno" id="pageno" value="1">
			
		</div>
	</div>
</section>

<div class="container pagination-main">
    <div class="pagination-wrapper center-btn">
    	<a href="javascript:void(0);" class="gradiant-btn" id="loadmore" style="pointer-events: all;">Load More</a>
        <!-- <ul id="pagination">
            <li class="prev">
                <a data-paged="1" href="javascript:void(0);"><img src="/wp-content/uploads/2024/01/DskBtn-L-Arrow-Default-2.svg" alt="Prev Icon"></a>
            </li>
            <li class="next">
                <a data-paged="2" href="javascript:void(0);"><img src="/wp-content/uploads/2024/01/DskBtn-R-Arrow-Default-2.svg" alt="Next Icon"></a>
            </li>
        </ul>
        <div class="page-numbers">
            <p>Page <span>1</span> of <span>10</span></p>
        </div> -->
    </div>
</div>

<?php if($cta_section['title']){ ?>
	<section class="bg-navy-blue cta-sec text-center l1-cta">
		<div class="container">
			<div class="row">
				<h2 class="white"><?php echo $cta_section['title']; ?></h2>
				<div class="white cta-content"><?php echo $cta_section['content']; ?></div>
				<div class="btn-wrapper cta-btns">
				<?php if($cta_section['button_text_1']){ ?>
                	<a class="primary-btn" href="<?php echo $cta_section['button_link_1']['url']; ?>" target="<?php echo $cta_section['button_link_1']['target']; ?>"><?php echo $cta_section['button_text_1']; ?></a>
                <?php } ?>
                <?php if($cta_section['button_text_2']){ ?>
                	<a class="gradiant-btn" href="<?php echo $cta_section['button_link_2']['url']; ?>" target="<?php echo $cta_section['button_link_2']['target']; ?>"><?php echo $cta_section['button_text_2']; ?></a>
                <?php } ?>
                </div>
			</div>
		</div>
	</section>
<?php } ?>
	
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php get_footer(); ?>
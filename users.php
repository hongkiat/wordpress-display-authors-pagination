<?php
/*
Template Name: User Page
*/

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

		<?php
		
			$number 	= 10; 
			$paged 		= (get_query_var('paged')) ? get_query_var('paged') : 1;
			$offset 	= ($paged - 1) * $number;
			$users 		= get_users();
			$query 		= get_users('&offset='.$offset.'&number='.$number);
			$total_users = count($users);
			$total_query = count($query);
			$total_pages = intval($total_users / $number) + 1;

			echo '<ul id="users" class="clearfix">';

			foreach($query as $q) { ?>
				
				<li class="user clearfix">
					<div class="user-avatar">
						<?php echo get_avatar( $q->ID, 80 ); ?>	
					</div>
					<div class="user-data">

						<h4 class="user-name">
							<a href="<?php echo get_author_posts_url($q->ID);?>">
								<?php echo get_the_author_meta('display_name', $q->ID);?>
							</a>
						</h4>

						<?php if (get_the_author_meta('description', $q->ID) != '') : ?>
							<p><?php echo get_the_author_meta('description', $q->ID); ?></p>
						<?php endif; ?>

					</div>
				</li>
			
			<?php } 

			echo '</ul>';

			?>

			<?php
				if ($total_users > $total_query) {
					echo '<div id="pagination" class="clearfix">';
					echo '<span class="pages">Pages:</span>';
					  $current_page = max(1, get_query_var('paged'));
					  echo paginate_links(array(
							'base' => get_pagenum_link(1) . '%_%',
							'format' => 'page/%#%/',
							'current' => $current_page,
							'total' => $total_pages,
							'prev_next'    => false,
							'type'         => 'list',
					    ));
					echo '</div>';
				}
			?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
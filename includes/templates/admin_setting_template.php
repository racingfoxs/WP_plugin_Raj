<?php include_once( dirname( __FILE__ ) . '/header.php' ); ?>
<div class="wrap">
	
	<form method="post" action="<?php echo admin_url( 'edit.php?post_type=news&page=news-settings' ); ?>">
		<?php wp_nonce_field( 'news-settings-save', 'news_settings_nonce' ); ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<lable for="news_title">Relation News Title</lable>
					</th>
					<td><input type="text" name="news_title" id="news_title"
							value="<?php echo esc_attr( isset( $_POST['news_title'] ) ? $_POST['news_title'] : get_option( 'rp_news_title', 'Related News' ) ); ?>" required ></td>
				</tr>
				<tr>
					<th>
						<lable for="news_email">Relation News Email</lable>
					</th>
					<td><input required type="email" name="news_email" id="news_email"
							value="<?php echo esc_attr( isset( $_POST['news_email'] ) ? $_POST['news_email'] : get_option( 'rp_news_email' ), '' ); ?>" ></td>
				</tr>
				<tr>
					<th>
						<lable for="news_show_checkbox">Do you want to show ?</lable>
					</th>
					<td><input type="checkbox" name="news_show_checkbox" id="news_show_checkbox"
							value="1" <?php checked( get_option( 'rp_show_related', true ) ); ?> ></td>
				</tr>
				<tr>
					<th><label for="related_news_amount">Nunber of Articles</label></th>
					<td>
						<select id="related_news_amount" name="related_news_amount">
						<?php for ( $i = 1; $i <= 10; $i++ ) : ?>
							<option value="<?php echo $i; ?>" <?php selected( isset( $_POST['related_news_amount'] ) ? $_POST['related_news_amount'] : get_option( 'rp_related_amount', 3 ), $i ); ?> ><?php echo $i; ?> </option>
						<?php endfor; ?>
						</select>
					</td>
				</tr>

			</tbody>
		</table>
		<p class="submit">
			<input type="submit" name="submit" class="button button-primary" value="Save Changes">
		</p>
	</form>
</div>
<?php include_once( dirname( __FILE__ ) . '/footer.php' ); ?>

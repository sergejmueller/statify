<?php
/** Quit */
class_exists( 'Statify' ) || exit; ?>


<table class="form-table">
	<tr valign="top">
		<td>
			<fieldset>
				<label for="statify_days">
					<select name="statify[days]" id="statify_days">
						<?php foreach ( array( 7, 14, 21, 30, 84, 183, 365 ) as $days ) { ?>
							<option value="<?php echo (int) $days ?>" <?php selected(
								Statify::$_options['days'], (int) $days
							); ?>>
								<?php echo sprintf( '%d %s', (int) $days, esc_html__( 'days', 'statify' ) ); ?>
							</option>
						<?php } ?>
					</select>
					<?php esc_html_e( 'Period of data saving', 'statify' ); ?>
				</label>

				<label for="statify_limit">
					<select name="statify[limit]" id="statify_limit">
						<?php foreach ( range( 0, 12 ) as $amount ) { ?>
							<option <?php selected( Statify::$_options['limit'], (int) $amount ); ?>>
								<?php echo (int) $amount; ?>
							</option>
						<?php } ?>
					</select>
					<?php esc_html_e( 'Number of entries in top lists', 'statify' ); ?>
				</label>

				<label for="statify_today">
					<input type="checkbox" name="statify[today]" id="statify_today" value="1" <?php checked( Statify::$_options['today'], 1 ); ?> />
					<?php esc_html_e( 'Entries in top lists only for today', 'statify' ); ?>
				</label>

				<label for="statify_snippet">
					<input type="checkbox" name="statify[snippet]" id="statify_snippet" value="1" <?php checked( Statify::$_options['snippet'], 1 ); ?> />
					<?php esc_html_e( 'Page tracking via JavaScript', 'statify' ); ?>
					<small>(<?php esc_html_e( 'recommended if caching is in use', 'statify' ); ?>)</small>
				</label>

				<label for="statify_blacklist">
					<input type="checkbox" name="statify[blacklist]" id="statify_blacklist" value="1" <?php checked( Statify::$_options['blacklist'], 1 ); ?> />
					<?php esc_html_e( 'Use the \'Comment Blacklist\' to filter referrer.', 'statify' ); ?>
				</label>
			</fieldset>
		</td>
	</tr>
</table>


<p class="meta-links">
	<a href="<?php esc_html_e( 'https://wordpress.org/plugins/statify/faq/', 'statify' ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'FAQ', 'statify' ); ?></a>
	&bull; <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=LG5VC9KXMAYXJ" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Donate', 'statify' ); ?></a>
	&bull; <a href="https://wordpress.org/support/plugin/statify" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Support', 'statify' ); ?></a>
	<?php if ( strpos( get_locale(), 'de' ) !== false ) { ?>
		&bull; <a href="https://github.com/pluginkollektiv/statify/wiki" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Wiki', 'statify' ); ?></a>
	<?php } ?>
</p>

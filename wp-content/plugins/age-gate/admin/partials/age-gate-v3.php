<div class="wrap">
  <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

  <div class="age-gate-update">
        <p><strong>Age Gate version 3 will be releasing soon!</strong></p>

        <p>The next major release of Age Gate will be releases very soon. While for the most part there'll be little noticable difference, beyond performance, there are some major changes under the hood.</p>

        <p>Be sure to have a read of the <a href="https://agegate.io/docs/v3/getting-started/upgrading" target="_blank" rel="noopener noreferrer">upgrade information</a>, and about changes to the <a href="https://agegate.io/docs/v3/hooks-reference/deprecated" target="_blank" rel="noopener noreferrer">hooks available</a> on the documentation site</p>

        <p><strong>What's changing?</strong></p>

        <p>Version 3 is a complete re-write of the plugin. Some hooks have changed, some things have been simplified to make customisation less convoluted, and it's all together more efficient, which should also mean <i>faster</i>.</p>

        <p>There is now a far better code base to add more features and options sensibly and more quickly</p>

        <p>Some literal bullet points:</p>

        <ul>
            <li>Easier styling with CSS variables</li>
            <li>Vastly improved taxonomy inheritance with more granular control</li>
            <li>Better control over archives</li>
            <li>Improved hooks for extending the form</li>
            <li>Simpler for customisation for adding class names, aria-labels and other attributes</li>
            <li>Easier to change form layout, element order to suit your needs</li>
            <li>Template overrides for advanced users</li>
            <li>Troublesome WYSIWYG editor dropped in favour of Markdown</li>
            <li>It still won't have a pro version :)</li>
        </ul>

        <p><strong>Will Regions and logs still work?</strong></p>

        <p>Yes and no, or rather no and yes. Logs has already been updated to work with Age Gate 3. The Regions addon update has yet to be released, but will be along side the v3 release.</p>

        <p><strong>OK, what's <i>not</i> changing?</strong></p>

        <p>The majority of settings and customisations will still be available. Some very edge-case <i>advanced</i> options may have been removed in favour of simpler solutions.</p>

        <p><strong>When is the release likely?</strong></p>

        <p>Hopefully on or just after September 1st.</p>
    </div>
</div>
<?php set_transient('age_gate_3_message', 1, MONTH_IN_SECONDS) ?>

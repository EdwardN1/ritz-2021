wp.domReady( () => {

    wp.blocks.registerBlockStyle( 'core/heading', [
        {
            name: 'default',
            label: 'Default',
            isDefault: true,
        },
        {
            name: 'tosca-zero',
            label: 'Tosca Zero',
        },
        {
            name: 'tosca-zero-uppercase',
            label: 'Tosca Zero Uppercase',
        }
    ]);

    wp.blocks.registerBlockStyle( 'core/spacer', {
        name: 'default',
        label: 'Default',
        isDefault: true,
    });

    wp.blocks.registerBlockStyle( 'core/spacer', {
        name: 'responsive-large',
        label: 'Responsive Large',
    } );

    wp.blocks.registerBlockStyle( 'core/spacer', {
        name: 'responsive-medium',
        label: 'Responsive Medium',
    } );

    wp.blocks.registerBlockStyle( 'core/spacer', {
        name: 'responsive-small',
        label: 'Responsive Small',
    } );

} );
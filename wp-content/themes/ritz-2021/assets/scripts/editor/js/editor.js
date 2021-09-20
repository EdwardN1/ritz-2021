wp.domReady( () => {

    wp.blocks.registerBlockStyle( 'core/heading', [
        {
            name: 'default',
            label: 'Default',
            isDefault: true,
        },
        {
            name: 'text-uppercase',
            label: 'Uppercase',
        },
        {
            name: 'text-uppercase-extra-bottom-spacing',
            label: 'Uppercase with extra bottom spacing',
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

    wp.blocks.registerBlockStyle( 'core/paragraph', [
        {
            name: 'default',
            label: 'Default',
            isDefault: true,
        },
        {
        name: 'responsive-bottom-spacing',
        label: 'Responsive bottom spacing'
        },
        {
            name: 'no-bottom-spacing',
            label: 'No bottom spacing'
        }
    ] );


} );
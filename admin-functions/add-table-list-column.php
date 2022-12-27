<?php

/*
 *  Add custom column to the new List Table
 */

class MyCustomColumn extends \Give\Framework\ListTable\ModelColumn {
    public static function getId() {
        return 'my-custom-column';
    }

    public function getLabel() {
        return __('My Custom Column', 'textdomain');
    }

    /*
     * This method must return a string that may contains HTML
     */
    public function getCellValue($model, $locale = '') {
        return sprintf(
            '%s %d',
            __('Donation ID:', 'textdomain'),
            $model->id
        );
    }
}

function givewp_register_list_table_columns($list_table) {
    /*
     * Notes:
     * ->addColumnBefore('status', new MyCustomColumn()) will add the custom column before a specific one
     * ->addColumn(new MyCustomColumn()) will just add the custom column after all others
     * ->addColumnAfter('id'' new MyCustomColun()) will add the custom after a specific one
     *
     * setColumnVisibility method can be ommited in case the custom column doesn't need to be visible at load
     */
    $list_table
        ->addColumnBefore('status', new MyCustomColumn())
        ->setColumnVisibility(MyCustomColumn::getId(), true);

    return $list_table;
}
/*
 * Available hooks:
 * givewp_donation_forms_list_table
 * givewp_donations_list_table
 * givewp_donors_list_table
 * givewp_subscriptions_list_table
 */
add_filter('givewp_donations_list_table', 'givewp_register_list_table_columns');

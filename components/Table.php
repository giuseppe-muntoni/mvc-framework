<?php

namespace giuseppemuntoni\mvc\components;

use giuseppemuntoni\mvc\Model;

/**
 * Class Table
 *
 * @author Giuseppe Muntoni <g.muntoni.cs@gmail.com>
 * @package giuseppemuntoni\mvc\components
 */
class Table {

    /**
     * @var Model[] $datasource
     */
    public array $data;
    public array $styles;

    public function __construct(array $data, array $styles = [])
    {
        $this->data = $data;
        $this->styles = $styles;
    }

    public function __toString()
    {
        return sprintf('<table class=\'%s\'>
                <tr>
                    %s        
                </tr>
                    %s
            </table>',
            implode(" ", $this->styles),
            $this->tableHeaders(),
            $this->tableData()
        );
    }

    private function tableHeaders(): string {
        if (empty($this->data))
            return '';

        return implode("\n", array_map(function ($label) {
            return '<th>' . $label . '</th>';
            }, $this->data[0]->getLabels()));
    }

    private function tableData(): string {
        if (empty($this->data))
            return '';

        $rows = array_map(function ($row) {
            $attributes = array_keys($this->data[0]->getLabels());
            $htmlRow = '<tr>';
            foreach ($attributes as $attribute) {
                $htmlRow .= '<td>' . $row->{$attribute} . '</td>';
            }
            $htmlRow .= '</tr>';

            return $htmlRow;
        }, $this->data);

        return implode("\n", $rows);
    }




}

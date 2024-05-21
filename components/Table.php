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
    public string $tableId;
    public string $rowIdAttribute;
    public array $styles;
    public array $excluded;

    public function __construct(array $data, $tableId = "", $rowIdAttribute = "", array $excluded = [], array $styles = [])
    {
        $this->rowIdAttribute = $rowIdAttribute;
        $this->tableId = $tableId;
        $this->data = $data;
        $this->styles = $styles;
        $this->excluded = $excluded;
    }

    public function __toString()
    {
        return sprintf('<table id=\'%s\' class=\'%s\'>
                <tr>
                    %s        
                </tr>
                    %s
            </table>',
            $this->tableId,
            implode(" ", $this->styles),
            $this->tableHeaders(),
            $this->tableData()
        );
    }

    private function tableHeaders(): string {
        if (empty($this->data))
            return '';

        return implode("\n",
            array_map(function ($attribute) {
                return sprintf('<th id="%s"> %s </th>', $attribute, $this->data[0]->getLabels()[$attribute]);
            },
            array_filter(array_keys($this->data[0]->getLabels()), function ($attribute) {
                return !in_array($attribute, $this->excluded);
            })
        ));
    }

    private function tableData(): string {
        if (empty($this->data))
            return '';

        $rows = array_map(function ($row) {
            $attributes = array_filter(array_keys($this->data[0]->getLabels()), function ($attribute) {
                return !in_array($attribute, $this->excluded);
            });

            if (empty($this->rowIdAttribute))
                $htmlRow = '<tr>';
            else
                $htmlRow = sprintf('<tr id=\'%s\'>', $row->{$this->rowIdAttribute});

            foreach ($attributes as $attribute) {
                $htmlRow .= '<td id="' . $attribute . '">' . $row->{$attribute} . '</td>';
            }
            $htmlRow .= '</tr>';

            return $htmlRow;
        }, $this->data);

        return implode("\n", $rows);
    }




}

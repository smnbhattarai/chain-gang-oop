<?php

class Pagination
{
    public $current_page;
    public $per_page;
    public $total_count;

    public function __construct($page = 1, $per_page = 20, $total_count = 0)
    {
        $this->current_page = (int)$page;
        $this->per_page     = (int)$per_page;
        $this->total_count  = (int)$total_count;
    }

    public function offset()
    {
        return $this->per_page * ($this->current_page - 1);
    }

    public function total_pages()
    {
        return ceil($this->total_count / $this->per_page);
    }

    public function next_page()
    {
        $next = $this->current_page + 1;
        return ($next <= $this->total_pages()) ? $next : false;
    }

    public function previous_page()
    {
        $prev = $this->current_page - 1;
        return ($prev > 0) ? $prev : false;
    }

    public function previous_link($url = '')
    {
        if ($this->previous_page() != false) {
            return '<a href="' . $url . '?page=' . $this->previous_page() . '">&laquo; Previous</a> ';
        }


    }

    public function next_link($url = '')
    {
        if ($this->next_page() != false) {
            return ' <a href="' . $url . '?page=' . $this->next_page() . '">Next &raquo;</a>';
        }
    }

    public function number_links($url)
    {
        $output = "";
        for ($i = 1; $i <= $this->total_pages(); $i++) {
            if ($i == $this->current_page) {
                $output .= "<span class='selected'>{$i}</span>";
            } else {
                $output .= '<a href="' . $url . '?page=' . $i . '">' . $i . '</a>';
            }
        }
        return $output;
    }

    public function page_links($url)
    {
        $output = "";
        if ($this->total_pages() > 1) {
            $output .= '<div class="pagination">';
            $output .= $this->previous_link($url);
            $output .= $this->number_links($url);
            $output .= $this->next_link($url);
            $output .= "</div>";
        }
        return $output;
    }

}
<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RssFeed extends Component
{
    protected $results;

    public function render()
    {
        $feed = "http://feeds.skynews.com/feeds/rss/world.xml";
        $xml = simplexml_load_file($feed);

        $this->updateXml($xml);

        return view('livewire.rss-feed',['results' => $this->results]);
    }

    public function world()
    {
        $feed = "http://feeds.skynews.com/feeds/rss/world.xml";
        $xml = simplexml_load_file($feed);

        $this->updateXml($xml);
    }


    public function uk()
    {
        $feed = "http://feeds.skynews.com/feeds/rss/uk.xml";
        $xml = simplexml_load_file($feed);

        $this->updateXml($xml);
    }

    private function updateXml($xml)
    {

        foreach( $xml->children() as $item ){

            // Count Total Items in the Files
            $total_items = $item->item->count();
            for( $i=0; $i < $total_items; $i++ )
            {

                $title = $item->item[$i]->title;

                $link = $item->item[$i]->link;

                //$description = $item->item[$i]->description;

                $image = $item->item[$i]->enclosure->attributes()->url;


                $this->results[] = ['title' => $title,
                            'link' => $link,
                            //'desc' => $description,
                            'image' => $image

                ];
            }

            return;

    }


    }
}

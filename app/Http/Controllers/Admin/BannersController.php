<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Services\Notify\Facades\Notify;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;

class BannersController extends BaseController
{
    //region Private
    private $data = [];
    private $notify = false;
    private $page;

    private function render()
    {
        $this->data['banners'] = Banner::getBanners($this->page);
        if (Request::getMethod() == 'POST') {
            return $this->post();
        }
        return view('admin.pages.banners.' . $this->page, $this->data);
    }

    private function post()
    {
        $request = Request::all();
        foreach ($this->data['params'] as $key => $params) {
            if (array_key_exists($key, $request)) {
                $inputs = $request[$key];
                $count = $params['count'] ?? 1;
                $thisBanner = $this->data['banners'][$key] ?? [];
                if (count($thisBanner) > $count) {
                    $rows = $thisBanner->pluck('id')->toArray();
                    array_splice($rows, 0, $count);
                    Banner::whereIn('id', $rows)->delete();
                }
                for ($i = 0; $i < $count; $i++) {
                    $this->updateData($params['params'], $inputs[$i] ?? null, $key, $i);
                }
            }
        }
        Cache::forget(Banner::cacheKey($this->page));
        if ($this->notify) Notify::get('changes_saved');
        return redirect()->back();

    }

    private function updateData($params, $inputs, $key, $i)
    {
        if (arraySize($inputs)) {
            $data = [];
            foreach ($params as $index => $param) {
                if (is_array($param)) {
                    $type = $param['type'];
                    unset($param['type']);
                    $settings = $param;
                } else {
                    $type = $param;
                    $settings = [];
                }
                $banner = $this->data['banners'][$key][$i]['data'][$index] ?? null;
                $data[$index] = $this->updateParam($type, $settings, $inputs[$index] ?? null, $banner);
            }
            if (arraySize($data)) {
                $id = $this->data['banners'][$key][$i]['id'] ?? false;
                if (Banner::updateBanner($this->page, $key, $data, $id)) $this->notify = true;
            }
        }
        return true;
    }

    private function updateParam($type, $settings, $input, $banner)
    {
        switch ($type) {
            case 'image':
                return $this->typeImage($settings, $input, $banner);
                break;
            case 'labelauty':
                return $this->typeCheckbox($input);
                break;
            default:
                return $input;
        }
    }

    private function typeImage($settings, $input, $banner)
    {
        if (empty($settings['original_file'])) {
            $resize = [];
            if (array_key_exists('resize', $settings)) {
                $resize[] = [
                    'method' => $settings['resize'][0],
                    'width' => $settings['resize'][1],
                    'height' => $settings['resize'][2],
                    'upsize' => empty($settings['resize'][3]) ? false : true,
                ];
            } else $resize[] = ['method' => 'original'];
            if ($input && $input->isFile() &&
                $image = upload_image($input, 'u/banners/', $resize, !empty($banner) ? $banner : false)

            ) return $image;
        } else {
            if ($input && $input->isFile() && $image = upload_original_image($input, 'u/banners/', !empty($banner) ? $banner : false)) return $image;
        }
        return $banner;
    }

    private function typeCheckbox($input)
    {
        return $input ? true : false;
    }

    public function fixBanners()
    {
        Banner::fixBanners($this->settings);
    }

    public function renderPage($page)
    {
        if (!array_key_exists($page, $this->settings)) abort(404);
        $this->page = $page;
        $this->data['params'] = $this->settings[$page];
        return $this->render();
    }

    public function getSettings()
    {
        return $this->settings;
    }

    //endregion

    private $settings = [
        'home' => [
            'search' => [
                'params' => [
                    'image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, 500, true],
                        'hint' => false,
                    ],
                    'title' => 'title',
                ]
            ],
            'adv' => [
                'count' => 5,
                'params' => [
                    'title' => 'title',
                    'phone' => 'input',
                ]
            ],
            'adv_title' => [
                'params' => [
                    'title' => 'title',
                ]
            ],
            'suggestions' => [
                'params' => [
                    'title' => 'title',
                    'title1' => 'title',
                    'title2' => 'title',
                ]
            ],
            'suggestions2' => [
                'params' => [
                    'title' => 'title',
                    'title1' => 'title',
                    'title2' => 'title',
                ]
            ],
            'suggestions3' => [
                'params' => [
                    'title' => 'title',
                    'title1' => 'title',
                    'title2' => 'title',
                ]
            ],
            'about' => [
                'params' => [
                    'title' => 'title',
                    'desc' => 'text',
                    'button_text' => 'title',
                    'url' => 'input',
                    'image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, 810, true],
                    ],
                    'image2' => [
                        'type' => 'image',
                        'resize' => ['resize', 350, 180, true],
                    ]
                ]
            ],
            'app' => [
                'params' => [
                    'title' => 'title',
                    'desc' => 'text',
                    'button_img1' => [
                        'type' => 'image',
                        'resize' => ['resize', 200, 60, true],
                    ],
                    'button_img2' => [
                        'type' => 'image',
                        'resize' => ['resize', 200, 60, true],
                    ],
                    'url1' => 'input',
                    'url2' => 'input',
                    'image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, 810, true],
                    ],
                ]
            ],
            'news'=> [
                'params' => [
                    'title' => 'title'
                ]
            ]
        ],
        'about' => [
            'header' => [
                'params' => [
                    'title' => 'title',
                    'image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, null, true],
                        'hint' => false,
                    ],
                ]
            ],
            'content' => [
                'params' => [
                    'image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, 810, true],
                        'hint' => false,
                    ],
                    'title' => 'title',
                    'counter1' => 'number',
                    'counter1_text' => 'title',
                    'counter2' => 'number',
                    'counter2_text' => 'title',
                    'counter3' => 'number',
                    'counter3_text' => 'title',
                    'desc' => 'text',
                    'url' => 'input',
                    'after_slider' => 'text',
                    'after_image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, 810, true],
                        'hint' => false,
                    ],
                ]
            ],
        ],
        'projects' => [
            'header' => [
                'params' => [
                    'title' => 'title',
                    'image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, null, true],
                        'hint' => false,
                    ],
                ]
            ],
            'content' => [
                'params' => [
                    'title' => 'title',
                    'desc' => 'textarea',
                    'image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, null, true],
                        'hint' => false,
                    ],
                ]
            ],
        ],
        'contact' => [
            'content' => [
                'params' => [
                    'title' => 'title',
                    'text' => 'text',
                    'email_desc' => 'textarea',
                    'email_text' => 'textarea',
                    'address_text' => 'textarea',
                    'address_desc1' => 'textarea',
                    'address_desc2' => 'textarea',
                    'image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, null, true],
                        'hint' => false,
                    ],
                ]
            ],
            'socials' => [
                'count' => 4,
                'params' => [
                    'icon' => [
                        'type' => 'image',
                        'original_file' => 'true'
                    ],
                    'title' => 'input',
                    'fstx' => 'color',
                    'url' => 'input',
                ]
            ],
        ],
        'info' => [
            'seo' => [
                'params' => [
                    'title_suffix' => 'title',
                ]
            ],
            'contacts' => [
                'count' => 4,
                'params' => [
                    'phone' => 'input',
                    'email' => 'input',
                    'address' => 'title'
                ]
            ],
            'contact_email' => [
                'params' => [
                    'email' => 'input',
                ]
            ],
            'payments' => [
                'count' => 5,
                'params' => [
                    'image' => [
                        'type' => 'image',
                        'original_file' => 'true'
                    ],
                    'title' => 'input',
                    'active' => 'labelauty'
                ]
            ],
            'data' => [
                'params' => [
                    'header_logo' => [
                        'type' => 'image',
                        'original_file ' => true,
                    ],
                    'menu_logo' => [
                        'type' => 'image',
                        'original_file ' => true,
                    ],
                    'iframe' => 'input',
                    'contact_email' => 'input',
                    'min_sum' => [
                        'type' => 'number',
                        'min' => '0',
                        'max' => '99999',
                    ],
                    'product_image' => [
                        'type' => 'image',
                        'resize' => ['fit', 512, 288, true]
                    ],
                    'options_selected' => 'labelauty',
                ]
            ],
            'socials' => [
                'count' => 5,
                'params' => [
                    'color' => 'color',
                    'icon' => [
                        'type' => 'image',
                        'original_file' => 'true'
                    ],
                    'title' => 'input',
                    'url' => 'input',
                ]
            ],
            'footer_links' => [
                'count' => 10,
                'params' => [
                    'title' => 'title',
                    'url' => 'input',
                ]
            ],
            'map' => [
                'params' => [
                    'source' => 'input',
                ]
            ],
        ],
        'services' => [
            'header' => [
                'params' => [
                    'title' => 'title',
                    'image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, 600, true],
                        'hint' => false,
                    ],
                    'image2' => [
                        'type' => 'image',
                        'resize' => ['resize', 200, null, true],
                        'hint' => false,
                    ],
                ]
            ],
            'content' => [
                'params' => [
                    'title' => 'title',
                    'desc' => 'textarea',
                    'image' => [
                        'type' => 'image',
                        'resize' => ['resize', 1440, null, true],
                        'hint' => false,
                    ],
                ]
            ],
        ],
    ];
}

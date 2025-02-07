<?php
$response = [
    "message_code" => 200,
    "data" => [
        "key" => "",
        "promotion" => [
            "day" => "06",
            "slider" => [
                [
                    "link" => "https://app.lotsofwms.in/premium/",
                    "image" => "https://lotsofcode.in/wp-content/uploads/2024/01/Lotsofcode-1-1024x1024.png"
                ]
            ],
            "title" => "Promo del Mes del 22222",
            "code" => "aiojcusezycgp7eni3nqfd"
        ],
        "expired" => [
            "image" => "",
            "title" => "Renew your expired license today",
            "description" => "Is your license expired? Don't worry, renew easily and go back to enjoying all the benefits. Keep your access active and avoid interruptions in your service. Click now to renew and continue without problems!",
            "button" => [
                "link" => "https://lotsofcode.in/precios",
                "title" => "Renew your expired license today"
            ]
        ],
        "default_image" => [
            "default_image_user" => "https://crm.effess.in/api/uploads/assets/images/custom/whatscrm.png",
            "default_image_group" => "https://crm.effess.in/api/uploads/assets/images/custom/whatscrm.png"
        ],
        "system_icons" => [
            "icon_search" => "https://crm.effess.in/api/uploads/assets/images/custom/whatscrm.png"
        ],
        "global" => [
            "color_ligth_primary" => "#04d79e",
            "color_dark_primary" => "#04d79e"
        ],
        "logo" => [
            "data" => [
                "logo_image" => "https://app.lotsofwms.in/assets/images/custom/whatscrm.png",
                "logo_link" => [
                    "title" => "lotsofcode",
                    "url" => "919214996678",
                    "target" => ""
                ]
            ],
            "style" => [
                "logo_background_ligth" => "#ffffff",
                "logo_background_dark" => "#222e35"
            ]
        ],
        "buttons" => [
            "data" => [
                [
                    "id" => "sending_messages",
                    "title" => "⚡📢 Flash Broadcasts",
                    "sub_title" => "Quick and emergency broadcasts",
                    "icon" => "https://app.lotsofwms.in/assets/icons/difusiones-flash-2.gif",
                    "help" => "<p>.</p>"
                ],
                [
                    "id" => "lists",
                    "title" => "🏷️🔖 Custom Tabs",
                    "sub_title" => "Pair your labels and organize like a pro",
                    "icon" => "https://app.lotsofwms.in/assets/icons/pestanas-2.gif",
                    "help" => "<p>.</p>"
                ],
                [
                    "id" => "templates",
                    "title" => "📃 Templates",
                    "sub_title" => "Create and organize your templates",
                    "icon" => "https://app.lotsofwms.in/assets/icons/plantillas-2.gif",
                    "help" => "<p>.</p>"
                ],
                // Add other button data as necessary
            ],
            "styles" => [
                "btn_background_ligth" => "#ffffff",
                "btn_icon_background_ligth" => "#ffffff",
                "btn_text_ligth" => "#04d79e",
                "btn_background_dark" => "#ffffff",
                "btn_icon_background_dark" => "#202c33",
                "btn_text_dark" => "#04d79e"
            ]
        ],
        "loading" => [
            "loading_image" => "https://app.lotsofwms.in/assets/icons/cargando-2.gif",
            "loading_title" => "Welcome to PuppyCRM 3.0",
            "loading_title_description" => "<div style=\"text-align: center;\">\n    <strong>Loading libraries&#8230;</strong>😁<br />\n    <strong>Just a moment, we’ll be done shortly</strong>🙏\n</div>",
            "loading_button" => "<p>Close</p>"
        ],
        "table_price" => [
            [
                "id" => 1122,
                "url" => "https://lotsofcode.in",
                "title" => "puppyCRM Premium 3 Days Trial",
                "description" => "<strong>TODAS LAS FUNCIONALIDADES ACTIVAS</strong>",
                "features" => [
                    "Message automation",
                    "Unlimited messaging",
                    "Contact tagging and segmentation functionality",
                    "Unlimited contact management",
                    "Full conversation history",
                    "Detailed reports and analysis",
                    "Advanced integration with WhatsApp",
                    "Priority support via email and live chat",
                    "All features of the free plan"
                ],
                "regular_price" => "<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">USD</span>&nbsp;0.00</bdi></span>",
                "old_price" => null,
                "currency_symbol" => "USD",
                "subscription_time" => "1 mes",
                "variations" => []
            ],
            // Add other table_price entries as necessary
        ]
    ]
];

$userData = [
    "phone" => "919227780446",
    "unique_id" => "MTcyOTkyMzIyMjE5Ny0xenB0dTRnNA==",
    "license" => "8VWC-CuFf-ukzl-02MN"
];

// Output the data as JSON
echo json_encode($response);
echo json_encode($userData);
?>

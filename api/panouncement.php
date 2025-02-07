<?php
// getanouncement

header("Access-Control-Allow-Origin: *"); // Replace '*' with a specific domain if needed, e.g., 'https://web.whatsapp.com'
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Content-Type: application/json");

include("../include/conn.php");
include("../include/function.php");

$response = [
  "message_code" => 200,
  "data" => [
    "key" => "",
    "promotion" => [
      "day" => "06",
      "slider" => [
        [
          "link" => "https://botcrm.wazbulk.in/login.phpproduct/waziper-with-buttons-and-list-download-2024/",
          "image" => "https://botcrm.wazbulk.in/login.phpwp-content/uploads/2024/10/maxresdefault-768x432.jpg"
        ]
      ],
      "title" => "Waziper with buttons and list download 2024",
      "code" => "Mastermind DEVELOPERS"
    ],
    "expired" => [
      "image" => "https://whatsapp-crm.online/AdminCrm/api/res/expired.jpg",
      "title" => "Renueva tu licencia expirada hoy",
      "description" => "¿Tu licencia ha expirado? No te preocupes, renueva fácilmente y vuelve a disfrutar de todos los beneficios. Mantén tu acceso activo y evita interrupciones en tu servicio. ¡Haz clic ahora para renovar y continuar sin problemas!",
      "button" => [
        "link" => "https://whatsapp-crm.online/AdminCrm/login.phpproduct/whatsapp-crm-3-5-extension-admin-panel-chatgpt-kanban-dashboard-google-meet-2024/",
        "title" => "Renueva tu licencia expirada hoy"
      ]
    ],
    "default_image" => [
      "default_image_user" => "https://botcrm.wazbulk.in/assets/images/logo/logo.png",
      "default_image_group" => "https://botcrm.wazbulk.in/assets/images/logo/logo.png"
    ],
    "system_icons" => [
      "icon_search" => "https://btn.pushflow.xyz/writable/uploads/1730096082_cc7f40b2610cd476173a.png"
    ],
    "global" => [
      "color_ligth_primary" => "#04d79e",
      "color_dark_primary" => "#04d79e"
    ],
    "logo" => [
      "data" => [
        "logo_image" => "https://botcrm.wazbulk.in/assets/images/logo/logo.png",
        "logo_link" => [
          "title" => "ONBVN DEVELOPERS",
          "url" => "917500112492",
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
          "id" =>  "sending_messages",
          "title" =>  "⚡📢 Transmisiones",
          "sub_title" =>  "Transmisiones rápidas y de emergencia",
          "icon" =>  "https://pkfamily.xyz/assets/icons/difusiones-flash-2.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "lists",
          "title" =>  "🏷️🔖 Pestañas Personalizadas",
          "sub_title" =>  "Empareja tus etiquetas y organiza como un profesional",
          "icon" =>  "https://pkfamily.xyz/assets/icons/pestanas-2.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "templates",
          "title" =>  "📃 Plantillas",
          "sub_title" =>  "Crea y organiza tus plantillas",
          "icon" =>  "https://pkfamily.xyz/assets/icons/plantillas-2.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "workflow",
          "title" =>  "🤖 Chatbots",
          "sub_title" =>  "Crea y personaliza tu chatbot de autorespuesta",
          "icon" =>  "https://pkfamily.xyz/assets/icons/chatbot-2.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "schedule_messages",
          "title" =>  "👨‍💻 Difusiones Programadas",
          "sub_title" =>  "Programa todos tus mensajes",
          "icon" =>  "https://pkfamily.xyz/assets/icons/difusiones-programadas-3.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "scheduled_shipments",
          "title" =>  "🗓️⏰ Notificaciones Programadas",
          "sub_title" =>  "Notifica a un cliente en el futuro",
          "icon" =>  "https://pkfamily.xyz/assets/icons/notificaciones-programadas-2.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "notes",
          "title" =>  "🗒️ Notas",
          "sub_title" =>  "Escribe todo y no olvides nada!",
          "icon" =>  "https://pkfamily.xyz/assets/icons/notas-2.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "reminder",
          "title" =>  "🔔 Recordatorios",
          "sub_title" =>  "Recuerda a tus clientes cualquier cosa que desees",
          "icon" =>  "https://pkfamily.xyz/assets/icons/recordatorios-2.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "kanban_board",
          "title" =>  "🗃️📋 Tablero Kanban",
          "sub_title" =>  "Organiza todos tus clientes con esta poderosa herramienta",
          "icon" =>  "https://pkfamily.xyz/assets/icons/tablero-kanban-2.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "functions",
          "title" =>  "🕹️ Funciones",
          "sub_title" =>  "Importa y exporta contactos, enlaces personalizados y mucho más...",
          "icon" =>  "https://pkfamily.xyz/assets/icons/funciones-2.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "tools_free",
          "title" =>  "Herramientas",
          "sub_title" =>  "Conjuntos de funciones gratuitas",
          "icon" =>  "https://pkfamily.xyz/assets/icons/herramientas-gratis-2.gif",
          "help" =>  "<p>.</p>\n"
        ],
        [
          "id" =>  "user",
          "title" =>  "🗣️✨ Usuario",
          "sub_title" =>  "Tu panel de usuario privado",
          "icon" =>  "https://pkfamily.xyz/assets/icons/usuario-2.gif",
          "help" =>  "<p>.</p>\n"
        ]
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
      "loading_image" => "https://hellowhatsapp.cloud/logo/whatsapp.gif",
      "loading_title" => "WA CRM 5.0",
     "loading_title_description" => "<div style=\"text-align: center;\">\n
    <strong>Loading libraries&#8230;</strong>🤗<br />\n
    <strong>Welcome To WA CRM</strong>✌️<br />\n
    <a href=\"https://botcrm.wazbulk.in/login.php\" target=\"_blank\" style=\"text-decoration: none;\">\n
        <button style=\"margin-top: 15px; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;\">Buy Licence</button>\n
    </a>\n
</div>\n",
      "loading_button" => "<p>Close</p>\n"
    ],
    "table_price" => [
      [
        "id" => 1122,
        "url" => "https://whatsapp-crm.online/AdminCrm/login.php",
        "title" => "WhatsApp CRM Premium",
        "description" => "<strong>TODAS LAS FUNCIONALIDADES ACTIVAS</strong>",
        "features" => [
          "Automatización de mensajes ",
          "Mensajería ilimitada ",
          "Funcionalidad de etiquetado y segmentación de contactos ",
          "Gestión de contactos ilimitada ",
          "Historial completo de conversaciones ",
          "Informes y análisis detallados ",
          "Integración avanzada con WhatsApp ",
          "Soporte prioritario por correo electrónico y chat en vivo ",
          "Todas las características disponibles"
        ],
        "regular_price" => "<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">USD</span>&nbsp;0.00</bdi></span>",
        "old_price" => null,
        "currency_symbol" => "USD",
        "subscription_time" => "1 mes",
        "variations" => []
      ],
      [
        "id" => 1458,
        "url" => "https://websitesale.shop",
        "title" => "WhatsApp CRM Premium",
        "description" => "",
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
        "regular_price" => "<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">USD</span>&nbsp;Get offer</bdi></span>",
        "old_price" => null,
        "currency_symbol" => "USD",
        "subscription_time" => "1 mes",
        "variations" => [
          [
            "name" => "MES",
            "regular_price" => "<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">USD</span>&nbsp;Get offer</bdi></span>",
            "old_price" => "<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">USD</span>&nbsp;123.99</bdi></span>"
          ],
          [
            "name" => "AÑO",
            "regular_price" => "<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">USD</span>&nbsp;Obtén oferta</bdi></span>",
            "old_price" => "<span class=\"woocommerce-Price-amount amount\"><bdi><span class=\"woocommerce-Price-currencySymbol\">USD</span>&nbsp;970.88</bdi></span>"
          ]
        ]
      ]
    ]
  ]
];

echo json_encode($response);
?>

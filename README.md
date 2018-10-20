## TPO IA

Cumple con lo necesario pero tiene errores, si quieren modifiquenlo.

- Instalar php y composer
- Ir a la carpeta del proyecto
- Composer update
- Crear carpeta app/config:
	Crear archivo parameters.dev:
	'''php
	
			define('DB_USERNAME', '');
			define('DB_PASSWORD', '');
			define('DB_HOST', 'localhost');
			define('DB_NAME', 'TPO_IA');
			define('CONFIDENCE', 0.6);
			define('AZURE_BASE_URL', 'https://eastus2.api.cognitive.microsoft.com/face/v1.0/');
			define ('S3_KEY', '');
			define ('S3_SECRET', '');
'''


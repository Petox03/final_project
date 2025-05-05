## API Endpoints

Base URL: `https://final-project-master-cyz8nu.laravel.cloud/api`

### 1. POST /register
**Descripción:** Registrar un nuevo usuario.

**Body (JSON):**
```json
{
  "name": "Juan Pérez",
  "email": "juan.perez@email.com",
  "password": "SuperSecreto123"
}
```

**Respuesta:**
```json
{
  "message": "Usuario registrado correctamente",
  "user": {
    "id": 1,
    "name": "Juan Pérez",
    "email": "juan.perez@email.com",
    "created_at": "2025-05-05T08:10:17.000000Z",
    "updated_at": "2025-05-05T08:10:17.000000Z"
  },
  "token": "1|VH7IHZeW41rPQ1TBqHXNCEmvRg0lqyUW8frbufw1474f0f01"
}
```

### 2. POST /login
**Descripción:** Iniciar sesión.

**Body (JSON):**
```json
{
  "email": "juan.perez@email.com",
  "password": "SuperSecreto123"
}
```

**Respuesta:**
```json
{
  "message": "Login exitoso",
  "token": "2|tESSdtyCBeymqeTr2bm3ZnvsYOffnzEtZGtRKY6dce659d09"
}
```

### 3. POST /logout
**Descripción:** Cerrar sesión.

**Headers:**
```
Authorization: Bearer {{authToken}}
Content-Type: application/json
```

**Body:** `{}`

**Respuesta:**
```json
{
  "message": "Sesión cerrada correctamente"
}
```

### 4. GET /user
**Descripción:** Obtener datos del usuario autenticado.

**Headers:**
```
Authorization: Bearer {{authToken}}
Content-Type: application/json
```

**Respuesta:**
```json
{
  "id": 1,
  "name": "Juan Pérez",
  "email": "juan.perez@email.com",
  "email_verified_at": null,
  "created_at": "2025-05-05T07:53:56.000000Z",
  "updated_at": "2025-05-05T07:53:56.000000Z"
}
```

### 5. GET /game/categories
**Descripción:** Obtener todas las categorías.

**Headers:**
```
Authorization: Bearer {{authToken}}
Content-Type: application/json
```

**Respuesta:**
```json
{
  "categories": [
    { "id":1, "name":"Filosofía", "description":"Palabras profundas..." },
    { "id":2, "name":"Ciencia",   "description":"Términos complejos..." },
    { "id":3, "name":"Literatura","description":"Vocabulario elevado..." },
    { "id":4, "name":"Política",   "description":"Palabras sofisticadas..." }
  ]
}
```

### 6. GET /game/words
**Descripción:** Obtener palabras del juego.
- Parámetros opcionales: `categories[]` (array IDs), `count` (número de palabras).
- Si ya solicitaste hoy, devuelve error.

**Headers:**
```
Authorization: Bearer {{authToken}}
Content-Type: application/json
```
**Query params:** `?categories[]=2&categories[]=1&count=3`

**Respuesta:**
```json
{
  "words": [ /* array de objetos Word con opciones */ ]
}
```

### 7. POST /game/answer
**Descripción:** Enviar respuestas.

**Headers:**
```
Authorization: Bearer {{authToken}}
Content-Type: application/json
```
**Body (JSON):**
```json
{
  "answers": [ {"word_id":6, "option_id":16}, … ]
}
```

**Respuesta:**
```json
{
  "results": [
    { "word_id":6, "correct":true, "message":"¡Respuesta correcta!" }
  ]
}
```

### 8. GET /game/history
**Descripción:** Obtener historial de palabras jugadas.

**Headers:**
```
Authorization: Bearer {{authToken}}
Content-Type: application/json
```

**Respuesta:**
```json
[ /* array de RegisteredWord con relación word */ ]
```

### 9. GET /game/progress
**Descripción:** Ver estadísticas del usuario.

**Headers:**
```
Authorization: Bearer {{authToken}}
Content-Type: application/json
```

**Respuesta:**
```json
{
  "total_correct_words":1,
  "total_days_played":1,
  "accuracy":100,
  "current_streak":1
}
```

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
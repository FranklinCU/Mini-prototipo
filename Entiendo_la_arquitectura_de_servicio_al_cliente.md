# Arquitectura — Módulo Servicio al Cliente

## Objetivo
Comprender y documentar la arquitectura del módulo para mantener código mantenible, testeable y consistente.

---

## 1) Comprender la estructura de carpetas del módulo

### Propuesta de carpetas (ejemplo)
```
app/
  Http/
    Controllers/
    Requests/
  Application/
    Service/
      UseCases/
      DTOs/
  Domain/
    Service/
      Services/
      Policies/
      Events/
      Listeners/
  Models/
  Providers/
```

### Por qué
Separar HTTP, aplicación y dominio evita controladores inflados y facilita pruebas, cambios y evolución.

---

## 2) Entender el flujo Controller → Service → Domain

### Flujo recomendado
1. Controller recibe la petición.
2. FormRequest valida y autoriza.
3. UseCase coordina el caso de uso.
4. Service Layer aplica reglas de negocio.
5. Model persiste o consulta.

### Por qué
El flujo reduce acoplamiento y hace cada capa reemplazable y testeable.

---

## 3) Identificar el rol de Service Layer / Use Cases

### Service Layer
- Contiene reglas de negocio reutilizables.
- No depende de HTTP ni de respuestas.

### Use Cases
- Orquestan un flujo completo (crear, actualizar, listar).
- Llaman al Service Layer y manejan transacciones.

### Por qué
Clarifica responsabilidades y evita duplicación en controladores.

---

## 4) Policies y autorización

### Rol
- Centralizar reglas de acceso por acción y recurso.
- Se usa en `authorize()` de FormRequest o en Controller.

### Ubicación sugerida
- `app/Domain/Service/Policies`

### Por qué
Evita permisos dispersos y facilita mantenimiento de seguridad.

---

## 5) Form Requests para validación

### Rol
- Validar entrada y ejecutar autorización.
- Estandarizar respuestas de error 422.

### Ubicación sugerida
- `app/Http/Requests`

### Por qué
Mantiene controladores delgados y reglas reutilizables.

---

## 6) Eventos, listeners y manejo de transacciones

### Eventos y listeners
- Eventos: `ServiceCreated`, `ServiceUpdated`.
- Listeners: auditoría, notificaciones, sincronizaciones.

### Transacciones
- Usar transacción cuando hay más de una escritura dependiente.

### Ubicación sugerida
- `app/Domain/Service/Events`
- `app/Domain/Service/Listeners`

### Por qué
Desacopla efectos secundarios y protege integridad de datos.

---

## 7) Reglas arquitectónicas y buenas prácticas

1. Controladores sin lógica de negocio.
2. Todo flujo pasa por UseCase.
3. Validación solo en Form Requests.
4. Autorización solo en Policies.
5. Respuestas API con Resources.
6. Transacciones en operaciones atómicas múltiples.
7. Pruebas para éxito y validación.
8. UI nunca accede modelos directamente.

---
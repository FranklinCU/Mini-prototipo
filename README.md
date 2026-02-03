
# Mini Prototipo Laravel: Tareas

## Estructura de Carpetas

```
app/
├── Http/
│   ├── Controllers/      # Controladores (TaskController)
│   └── Requests/         # Form Requests (si se usan)
├── Services/             # Lógica de negocio (TaskService)
├── Policies/             # Reglas de autorización (TaskPolicy)
├── Events/               # Eventos de dominio (TaskCreated)
├── Listeners/            # Listeners de eventos (TaskCreatedListener)
├── Models/               # Modelos Eloquent (User, Task, TaskLog)
└── Providers/            # Proveedores de servicios (Auth, Event, App)

resources/
└── views/
	├── auth/             # Vista de login simple
	└── tasks/            # Vista Blade de tareas

routes/
└── web.php               # Rutas web (login, logout, tareas)

database/
├── migrations/           # Migraciones users, tasks, task_logs
├── factories/            # Factory de User (si se usa)
└── seeders/              # Seeder base (si se usa)
```

### Descripción de Carpetas

- **Controllers**: Orquestan peticiones, autorizan y coordinan la respuesta.
- **Requests**: Validan datos de entrada si se usan.
- **Services**: Lógica de negocio y transacciones.
- **Policies**: Permisos por rol o autor de tarea.
- **Events**: Eventos de dominio (TaskCreated).
- **Listeners**: Reaccionan a eventos y crean logs.
- **Models**: Modelos Eloquent de la base de datos.
- **Providers**: Registran policies y listeners.
- **Views**: UI del login y de tareas.
- **Routes**: Rutas de login, logout y tareas.
- **Migrations**: Esquema de tablas users, tasks, task_logs.

---

## Flujo de Trabajo del Proyecto

1. **Login**: El usuario entra a /login y se autentica con username y password. Si no existe, se crea con rol "usuario".
2. **Acceso**: Si esta autenticado, se redirige a /tasks. Si no, vuelve a /login.
3. **Crear tarea**: El controlador valida, autoriza y crea la tarea.
4. **Service**: Crea Task y TaskLog en transaccion y dispara TaskCreated.
5. **Event/Listener**: El listener crea un log adicional.
6. **Actualizar/Eliminar**: Solo autor o admin pueden marcar o eliminar.
7. **Logout**: El usuario sale y puede cambiar de cuenta.

### Ejemplo de Flujos

- **Login**: POST /login → Crea usuario si no existe → Autentica → Redirige
- **Crear tarea**: POST /tasks → Controller (autoriza) → Service (crea Task + TaskLog y dispara evento) → Listener (crea log) → Redirige
- **Actualizar tarea**: PUT /tasks/{task} → Controller (autoriza) → Marca como hecha → Redirige
- **Eliminar tarea**: DELETE /tasks/{task} → Controller (autoriza) → Elimina → Redirige

# Hospital Management System (HMS)

A modular Hospital Management System built with Laravel, Livewire, and a Domain-Driven Design inspired architecture.

The project is designed to model real hospital workflows while keeping business logic separated from infrastructure, persistence, and presentation.

---

## About The Project

HMS is a hospital management system focused on building a maintainable and scalable backend architecture.

The system is being developed around business domains instead of putting all application logic into controllers or Eloquent models.

The main architectural flow is:

```text
Request
   ↓
DTO
   ↓
UseCase
   ↓
Entity
   ↓
Repository
   ↓
Database
   ↓
Mapper
   ↓
Entity
```

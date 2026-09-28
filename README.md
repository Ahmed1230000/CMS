# Hospital Management System (HMS)

A modular Hospital Management System built with Laravel, Livewire, and a Domain-Driven Design inspired architecture.

The project is designed to model real hospital workflows while keeping business logic separated from infrastructure, persistence, and presentation.

The system focuses on building a maintainable, scalable, and production-oriented backend while applying practical software engineering concepts such as:

- Domain-Driven Design
- Clean separation of concerns
- Use Case based application logic
- Repository Pattern
- Entities and Value Objects
- DTOs
- Mappers
- Authentication & Authorization
- Database transactions
- Concurrency control
- Pessimistic locking
- Payment integrations
- Webhooks
- Automated testing
- Database indexing and query optimization
- Livewire-based presentation
- Modular domain organization


---

# Table of Contents

- [About The Project](#about-the-project)
- [Project Goals](#project-goals)
- [Core Architecture](#core-architecture)
- [Architectural Flow](#architectural-flow)
- [Project Domains](#project-domains)
- [Authentication](#authentication)
- [Email Verification](#email-verification)
- [Authorization](#authorization)
- [Hospital Workflows](#hospital-workflows)
- [Appointment Management](#appointment-management)
- [Medical Records](#medical-records)
- [Prescription Management](#prescription-management)
- [Pharmacy](#pharmacy)
- [Invoice Management](#invoice-management)
- [Payment Management](#payment-management)
- [Paymob Integration](#paymob-integration)
- [Webhook Processing](#webhook-processing)
- [Concurrency & Transactions](#concurrency--transactions)
- [Database Design](#database-design)
- [Database Indexing](#database-indexing)
- [Pagination](#pagination)
- [Testing Strategy](#testing-strategy)
- [Testing Architecture](#testing-architecture)
- [Factories & Seeders](#factories--seeders)
- [Livewire](#livewire)
- [DDD Package](#ddd-package)
- [Custom Flow Generator](#custom-flow-generator)
- [Project Structure](#project-structure)
- [Security](#security)
- [Error Handling](#error-handling)
- [Environment Configuration](#environment-configuration)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [Running The Application](#running-the-application)
- [Testing](#testing)
- [Development Principles](#development-principles)
- [Future Improvements](#future-improvements)


---

# About The Project

HMS is a modular Hospital Management System designed around real-world hospital workflows.

Instead of placing business logic inside controllers or Eloquent models, the application separates responsibilities across:

- Presentation
- DTOs
- Use Cases
- Entities
- Value Objects
- Repositories
- Mappers
- Infrastructure services
- Database models

The goal is to make the system easier to understand, test, maintain, and extend.


---

# Project Goals

The project is built with several goals in mind:

1. Model real hospital business workflows.
2. Apply Domain-Driven Design concepts in a practical Laravel project.
3. Keep business logic independent from controllers.
4. Reduce direct coupling between business logic and Eloquent.
5. Make Use Cases independently testable.
6. Apply proper database design and indexing.
7. Handle concurrent operations safely.
8. Integrate external payment providers.
9. Process asynchronous payment webhooks safely.
10. Build a realistic backend suitable for production-oriented development.


---

# Core Architecture

The project follows a Domain-Driven Design inspired architecture.

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
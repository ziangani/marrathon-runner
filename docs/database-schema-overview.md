# Database Schema Overview

## 1. Schema Design Principles

This database schema follows these design principles:

1. **Normalization**: Tables are normalized to reduce redundancy
2. **Consistent Naming**: Snake_case for tables (plural) and columns
3. **Timestamps**: All tables include `created_at` and `updated_at`
4. **Soft Deletes**: Essential tables include `deleted_at` for soft deletion
5. **Indexing**: Foreign keys and frequently queried columns are indexed
6. **Constraints**: Appropriate foreign key constraints with cascade or restrict
7. **Data Types**: PostgreSQL-specific types are used where appropriate

## 2. Entity Relationship Diagram (ERD)

```
+---------------+       +------------------+       +------------------+
|    users      |       |      roles       |       |   permissions    |
+---------------+       +------------------+       +------------------+
| id            |       | id               |       | id               |
| name          |       | name             |       | name             |
| email         |       | display_name     |       | display_name     |
| password      |       | description      |       | description      |
| remember_token|       | created_at       |       | created_at       |
| email_verified|       | updated_at       |       | updated_at       |
| created_at    |       +------------------+       +------------------+
| updated_at    |               ^                          ^
| deleted_at    |               |                          |
+---------------+               |                          |
       ^                        |                          |
       |                        |                          |
       |                +-------+--------+         +-------+--------+
       |                |  role_user     |         | permission_role |
       |                +----------------+         +----------------+
       |                | role_id        |         | permission_id   |
       |                | user_id        |         | role_id         |
       |                | created_at     |         | created_at      |
       |                | updated_at     |         | updated_at      |
       |                +----------------+         +----------------+
       |
       |                +------------------+
       +--------------->|  user_profiles   |
       |                +------------------+
       |                | id               |
       |                | user_id          |
       |                | avatar           |
       |                | phone            |
       |                | address          |
       |                | settings         |
       |                | created_at       |
       |                | updated_at       |
       |                +------------------+
       |
       |                +------------------+
       +--------------->|  activity_logs   |
                        +------------------+
                        | id               |
                        | user_id          |
                        | log_name         |
                        | description      |
                        | subject_type     |
                        | subject_id       |
                        | causer_type      |
                        | causer_id        |
                        | properties       |
                        | created_at       |
                        | updated_at       |
                        +------------------+
```

```
+------------------+       +------------------+       +------------------+
|     modules      |       |   module_items   |       |  module_settings |
+------------------+       +------------------+       +------------------+
| id               |       | id               |       | id               |
| name             |       | module_id        |       | module_id        |
| description      |       | name             |       | key              |
| status           |       | description      |       | value            |
| user_id          |       | status           |       | created_at       |
| settings         |       | data             |       | updated_at       |
| created_at       |<------| created_at       |       +------------------+
| updated_at       |       | updated_at       |
| deleted_at       |       | deleted_at       |
+------------------+       +------------------+
```

```
+------------------+       +------------------+       +------------------+
|     reports      |       | scheduled_reports|       |   notifications  |
+------------------+       +------------------+       +------------------+
| id               |       | id               |       | id               |
| name             |       | report_id        |       | type             |
| description      |       | user_id          |       | notifiable_type  |
| type             |       | frequency        |       | notifiable_id    |
| parameters       |       | parameters       |       | data             |
| user_id          |       | recipients       |       | read_at          |
| created_at       |<------| next_run_at      |       | created_at       |
| updated_at       |       | last_run_at      |       | updated_at       |
| deleted_at       |       | created_at       |       +------------------+
+------------------+       | updated_at       |
                          | deleted_at       |
                          +------------------+
```

```
+------------------+       +------------------+
|      files       |       |     settings     |
+------------------+       +------------------+
| id               |       | id               |
| name             |       | key              |
| path             |       | value            |
| disk             |       | group            |
| mime_type        |       | description      |
| size             |       | is_private       |
| fileable_type    |       | created_at       |
| fileable_id      |       | updated_at       |
| created_at       |       +------------------+
| updated_at       |
| deleted_at       |
+------------------+
```

## 3. Table Definitions

### 3.1 Authentication & Authorization Tables

#### `users` - System Users
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| name | varchar(255) | Not null | User's full name |
| email | varchar(255) | Not null, Unique | User's email address |
| email_verified_at | timestamp | Nullable | When email was verified |
| password | varchar(255) | Not null | Hashed password |
| remember_token | varchar(100) | Nullable | Token for "remember me" |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |
| deleted_at | timestamp | Nullable | Soft delete timestamp |

#### `password_reset_tokens` - Password Reset Tokens
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| email | varchar(255) | PK | User's email address |
| token | varchar(255) | Not null | Reset token |
| created_at | timestamp | Nullable | Creation timestamp |

#### `roles` - User Roles
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| name | varchar(255) | Not null, Unique | Role name (slug) |
| display_name | varchar(255) | Not null | Human-readable name |
| description | text | Nullable | Role description |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

#### `permissions` - System Permissions
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| name | varchar(255) | Not null, Unique | Permission name (slug) |
| display_name | varchar(255) | Not null | Human-readable name |
| description | text | Nullable | Permission description |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

#### `role_user` - User-Role Pivot
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| role_id | bigint | FK | References roles.id |
| user_id | bigint | FK | References users.id |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

#### `permission_role` - Role-Permission Pivot
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| permission_id | bigint | FK | References permissions.id |
| role_id | bigint | FK | References roles.id |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

### 3.2 User Profile Tables

#### `user_profiles` - Extended User Information
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| user_id | bigint | FK, Not null | References users.id |
| avatar | varchar(255) | Nullable | Path to profile image |
| phone | varchar(20) | Nullable | Contact phone number |
| address | text | Nullable | Physical address |
| settings | jsonb | Nullable | User preferences |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

#### `activity_logs` - User Activity Tracking
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| log_name | varchar(255) | Nullable | Category of activity |
| description | text | Not null | Description of activity |
| subject_type | varchar(255) | Nullable | Affected model type |
| subject_id | bigint | Nullable | Affected model ID |
| causer_type | varchar(255) | Nullable | Causing model type |
| causer_id | bigint | Nullable | Causing model ID |
| properties | jsonb | Nullable | Additional data |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

### 3.3 Core Module Tables

#### `modules` - Core Business Modules
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| name | varchar(255) | Not null | Module name |
| description | text | Nullable | Module description |
| status | boolean | Default: true | Active status |
| user_id | bigint | FK, Not null | Creator reference |
| settings | jsonb | Nullable | Module settings |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |
| deleted_at | timestamp | Nullable | Soft delete timestamp |

#### `module_items` - Items Related to Modules
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| module_id | bigint | FK, Not null | References modules.id |
| name | varchar(255) | Not null | Item name |
| description | text | Nullable | Item description |
| status | boolean | Default: true | Active status |
| data | jsonb | Nullable | Item data |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |
| deleted_at | timestamp | Nullable | Soft delete timestamp |

#### `module_settings` - Module-Specific Settings
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| module_id | bigint | FK, Not null | References modules.id |
| key | varchar(255) | Not null | Setting key |
| value | text | Nullable | Setting value |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

### 3.4 Reporting Tables

#### `reports` - Report Definitions
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| name | varchar(255) | Not null | Report name |
| description | text | Nullable | Report description |
| type | varchar(50) | Not null | Report type |
| parameters | jsonb | Nullable | Report parameters |
| user_id | bigint | FK, Not null | Creator reference |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |
| deleted_at | timestamp | Nullable | Soft delete timestamp |

#### `scheduled_reports` - Report Scheduling Settings
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| report_id | bigint | FK, Not null | References reports.id |
| user_id | bigint | FK, Not null | Owner reference |
| frequency | varchar(50) | Not null | Schedule frequency |
| parameters | jsonb | Nullable | Specific parameters |
| recipients | jsonb | Not null | Email recipients |
| next_run_at | timestamp | Not null | Next scheduled run |
| last_run_at | timestamp | Nullable | Last execution time |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |
| deleted_at | timestamp | Nullable | Soft delete timestamp |

### 3.5 Notification Tables

#### `notifications` - User Notifications
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | uuid | PK | Unique identifier |
| type | varchar(255) | Not null | Notification class |
| notifiable_type | varchar(255) | Not null | Target model type |
| notifiable_id | bigint | Not null | Target model ID |
| data | jsonb | Not null | Notification content |
| read_at | timestamp | Nullable | When notification was read |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

### 3.6 File Management Tables

#### `files` - Uploaded Files
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| name | varchar(255) | Not null | Original filename |
| path | varchar(255) | Not null | File path/location |
| disk | varchar(50) | Not null | Storage disk |
| mime_type | varchar(100) | Not null | File MIME type |
| size | integer | Not null | File size in bytes |
| fileable_type | varchar(255) | Nullable | Related model type |
| fileable_id | bigint | Nullable | Related model ID |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |
| deleted_at | timestamp | Nullable | Soft delete timestamp |

### 3.7 Settings Tables

#### `settings` - Application Settings
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| key | varchar(255) | Not null, Unique | Setting key |
| value | text | Nullable | Setting value |
| group | varchar(100) | Not null | Settings group/category |
| description | text | Nullable | Setting description |
| is_private | boolean | Default: false | Whether value is sensitive |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

### 3.8 Email Tables

#### `email_logs` - Email Sending Records
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| from | varchar(255) | Not null | Sender email |
| to | varchar(255) | Not null | Recipient email |
| cc | text | Nullable | CC recipients (JSON) |
| bcc | text | Nullable | BCC recipients (JSON) |
| subject | varchar(255) | Not null | Email subject |
| body | text | Not null | Email body content |
| status | varchar(50) | Not null | Sending status |
| error | text | Nullable | Error message if failed |
| sent_at | timestamp | Nullable | When email was sent |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

### 3.9 API Related Tables

#### `personal_access_tokens` - API Authentication
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| tokenable_type | varchar(255) | Not null | Owner model type |
| tokenable_id | bigint | Not null | Owner model ID |
| name | varchar(255) | Not null | Token name/purpose |
| token | varchar(64) | Not null, Unique | Hashed token value |
| abilities | text | Nullable | Token permissions |
| last_used_at | timestamp | Nullable | Last usage timestamp |
| expires_at | timestamp | Nullable | Expiration timestamp |
| created_at | timestamp | Nullable | Creation timestamp |
| updated_at | timestamp | Nullable | Last update timestamp |

#### `api_logs` - API Request Logging
| Column | Type | Attributes | Description |
|--------|------|------------|-------------|
| id | bigint | PK, Auto-increment | Unique identifier |
| user_id | bigint | FK, Nullable | User making request |
| ip_address | varchar(45) | Not null | Client IP address |
| method | varchar(10) | Not null | HTTP method |
| path | varchar(255) | Not null | Request path |
| status_code | smallint | Not null | Response status code |
| response_time | integer | Not null | Response time in ms |
| user_agent | varchar(255) | Nullable | Client user agent |
| request_data | jsonb | Nullable | Request parameters |
| created_at | timestamp | Nullable | Creation timestamp |

## 4. Indexes and Constraints

### 4.1 Primary Keys
- All tables have primary key constraints on their `id` columns (except pivot tables)
- Pivot tables have composite primary keys on both foreign key columns

### 4.2 Foreign Keys
- All foreign key columns are indexed
- Most foreign keys use `CASCADE` for updates and `RESTRICT` for deletes
- Soft-deletable relations use `CASCADE` for both updates and deletes

### 4.3 Unique Constraints
- `users.email`
- `roles.name`
- `permissions.name`
- `settings.key`
- `personal_access_tokens.token`

### 4.4 Additional Indexes
- `users.deleted_at` - For efficient soft delete filtering
- `users.email_verified_at` - For filtering verified users
- `activity_logs.log_name` - For grouping by activity type
- `activity_logs.created_at` - For chronological filtering
- `notifications.read_at` - For filtering read/unread
- `modules.status` - For filtering active modules
- `modules.deleted_at` - For efficient soft delete filtering
- `files.fileable_type, fileable_id` - For polymorphic relations
- `settings.group` - For grouping settings

## 5. Data Types and Constraints

### 5.1 PostgreSQL-Specific Types
- `jsonb` used instead of `json` for better performance and indexing
- Text search capabilities using PostgreSQL's built-in text search
- Consider using `uuid` type for IDs where appropriate

### 5.2 Data Validation
- Enforce data integrity at the database level with:
  - `NOT NULL` constraints where appropriate
  - Check constraints for specific value ranges
  - Proper data types for all columns
  - Default values for commonly used fields

### 5.3 Cascading Actions
- `ON UPDATE CASCADE` for foreign keys to automatically update references
- `ON DELETE RESTRICT` to prevent deletion of referenced records
- `ON DELETE CASCADE` in specific cases where child records should be deleted

## 6. Migration Strategy

### 6.1 Migration Order
1. Create authentication tables (users, roles, permissions)
2. Create pivot tables for relationships
3. Create profile and activity tables
4. Create core module tables
5. Create supporting feature tables (reports, notifications)
6. Create utility tables (files, settings)
7. Add indexes and constraints

### 6.2 Data Migration
- Initial data seeding for:
  - Default roles and permissions
  - Admin user
  - Basic settings
  - Essential lookup data

### 6.3 Schema Evolution
- Use Laravel migrations for all schema changes
- Create separate migrations for each logical change
- Document breaking changes in migration comments
- Use timestamped migrations to maintain order

## 7. Optimization Considerations

### 7.1 Query Performance
- Indexes on frequently queried columns
- Denormalization where appropriate for performance
- Consider materialized views for complex reports
- Use appropriate PostgreSQL index types (B-tree, GIN, etc.)

### 7.2 Data Storage
- Use appropriate column types to minimize storage
- Consider table partitioning for large tables
- Implement archiving strategy for old data
- Configure autovacuum settings appropriately

### 7.3 Scalability
- Design schema with horizontal scaling in mind
- Consider sharding strategies for very large datasets
- Use connection pooling for efficient resource usage
- Implement efficient batch processing for large operations


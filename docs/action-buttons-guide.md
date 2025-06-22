# Action Buttons Guide

## Overview
Action buttons adalah tombol-tombol aksi yang biasa digunakan dalam tabel dan card untuk operasi CRUD (Create, Read, Update, Delete).

## Utility Classes

### Base Classes
- `action-btn-base`: Base styling untuk semua action buttons
- `action-btn-icon`: Untuk button icon only (8x8, digunakan di desktop table)
- `action-btn-text`: Untuk button dengan text (digunakan di mobile card)

### Variants
- `action-btn-view`: Styling untuk tombol "View/Detail" (hijau)
- `action-btn-edit`: Styling untuk tombol "Edit" (biru)
- `action-btn-delete`: Styling untuk tombol "Delete/Hapus" (merah)

### Container
- `action-buttons-group`: Container untuk group action buttons
- `action-buttons-group desktop`: Spacing untuk desktop table (space-x-1, justify-end)
- `action-buttons-group mobile`: Spacing untuk mobile card (space-x-2)

## Usage Examples

### Desktop Table (Icon Only)
```blade
<div class="action-buttons-group desktop">
    <a href="{{ route('admin.packages.show', $package) }}" 
       class="action-btn-icon action-btn-view"
       title="Lihat Detail">
        <x-icon name="eye" class="w-4 h-4" />
    </a>
    
    <a href="{{ route('admin.packages.edit', $package) }}" 
       class="action-btn-icon action-btn-edit"
       title="Edit">
        <x-icon name="edit" class="w-4 h-4" />
    </a>
    
    <button type="button"
            @click="deleteAction({{ $package->id }})"
            class="action-btn-icon action-btn-delete"
            title="Hapus">
        <x-icon name="delete" class="w-4 h-4" />
    </button>
</div>
```

### Mobile Card (With Text)
```blade
<div class="action-buttons-group mobile">
    <a href="{{ route('admin.packages.show', $package) }}" 
       class="action-btn-text action-btn-view">
        <x-icon name="eye" class="w-4 h-4 mr-1" />
        Detail
    </a>
    
    <a href="{{ route('admin.packages.edit', $package) }}" 
       class="action-btn-text action-btn-edit">
        <x-icon name="edit" class="w-4 h-4 mr-1" />
        Edit
    </a>
    
    <button type="button"
            @click="deleteAction({{ $package->id }})"
            class="action-btn-text action-btn-delete">
        <x-icon name="delete" class="w-4 h-4 mr-1" />
        Hapus
    </button>
</div>
```

## Benefits
1. **Konsistensi**: Semua action buttons memiliki styling yang sama
2. **Maintainability**: Mudah diubah dari satu tempat (app.css)
3. **Readability**: Developer lain mudah memahami dan menggunakan
4. **Responsive**: Berbeda styling untuk desktop dan mobile
5. **Accessibility**: Sudah include focus states dan proper contrast

## Icon Component
Komponen icon mendukung kedua parameter untuk backward compatibility:
- `type`: Parameter standar (digunakan di komponen button dan tempat lain)
- `name`: Parameter alternatif (digunakan di action buttons manual)

```blade
<!-- Kedua cara ini valid -->
<x-icon type="eye" class="w-4 h-4" />
<x-icon name="eye" class="w-4 h-4" />
```

## Implementation Files
- CSS: `resources/css/app.css`
- Example: `resources/views/admin/packages/index.blade.php`
- Icons: `resources/views/components/icon.blade.php`

## Notes
- Gunakan `action-btn-icon` untuk tabel desktop (lebih compact)
- Gunakan `action-btn-text` untuk mobile card (lebih user-friendly)
- Selalu sertakan `title` attribute untuk accessibility pada icon-only buttons
- Icon size standar: `w-4 h-4`
- Untuk button dengan text, tambahkan `mr-1` pada icon

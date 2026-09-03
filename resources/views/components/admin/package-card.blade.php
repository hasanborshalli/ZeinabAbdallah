<tr>
    <td class="fw-semibold">{{ $package->name }}</td>
    <td>{{ $package->formattedPrice() }}</td>
    <td>{{ $package->durationLabel() }}</td>
    <td class="text-muted small">{{ $package->features->count() }} features</td>
    <td>
        @if ($package->is_active)
        <span class="badge text-bg-success">Active</span>
        @else
        <span class="badge text-bg-secondary">Hidden</span>
        @endif
    </td>
    <td class="text-end">
        <a type="button" class="btn btn-sm btn-light" title="Edit package"
            href="{{ route('admin.packages.edit.page',$package->id) }}">
            <i class="bi bi-pencil"></i>
        </a>
        <button
            type="button"
            class="btn btn-sm btn-light text-danger"
            title="Delete package"
            data-bs-toggle="modal"
            data-bs-target="#deletePackageModal"
            data-delete-url="{{ route('admin.packages.delete', $package) }}"
            data-package-name="{{ $package->name }}"
        >
            <i class="bi bi-trash"></i>
        </button>
    </td>
</tr>
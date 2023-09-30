<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                <span class="px-2">Nummer</span>
            </th>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                <span class="px-2">Bearbeiter</span>
            </th>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                <span class="px-2">Status</span>
            </th>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2 table-col-address">
                <span class="px-2">Technischer Platz (Bezeichnung/Adress)</span>
            </th>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                <span class="px-2">Technischer Platz (Nummer)</span>
            </th>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                <span class="px-2"></span>
            </th>
        </tr>
    </thead>
    @if(isset($maintenanceOffers) && !$maintenanceOffers->isEmpty())
        <tbody>
            @foreach ($maintenanceOffers as $item)
            <?php
                $status_color = 'transparent';
                if($item->status != ''){
                    $status_color = App\Enums\Status::getColor($item->status);
                }
            ?>
            <tr style="background-color: <?= $status_color ?>">
                <td>
                    <div class="d-flex px-2 flex-column justify-content-center">
                        <h6 class="mb-0">{{ $item->id }}</h6>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-2 flex-column justify-content-center">
                        <h6 class="mb-0">{{ $item->user->name ?? 'Nicht zugeordnet' }}</h6>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-2 flex-column justify-content-center">
                        <p class="text-dark mb-0">{{ $item->status != '' ? App\Enums\Status::getLabel($item->status) : '' }}</p>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-2 flex-column justify-content-center table-col-address">
                        <p class="text-dark mb-0">{{ $item->technical_place_address }}</p>
                    </div>
                </td>
                <td>
                    <div class="d-flex px-2 flex-column justify-content-center">
                        <p class="text-dark mb-0">{{ $item->technical_place }}</p>
                    </div>
                </td>
                <td class="align-middle">

                    <x-anchors.view class="my-2" href="{{ route('maintenance.view', $item->id) }}"
                        data-original-title="" title=""></x-anchors.view>

                    <x-anchors.edit class="my-2" href="{{ route('maintenance.edit', $item->id) }}"
                        data-original-title="" title=""></x-anchors.edit>

                    <x-buttons.deleteConfirm.wrapper
                        action="{{ route('maintenance.destroy', $item->id)  }}">
                        <x-buttons.deleteConfirm.button class="my-2"></x-buttons.deleteConfirm.button>
                    </x-buttons.deleteConfirm.wrapper>
                </td>
            </tr>
            @endforeach
        </tbody>
    @endif
</table>
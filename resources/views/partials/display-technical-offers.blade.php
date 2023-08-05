<table class="table align-items-center mb-0">
    <thead>
        <tr>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                <span class="px-2">Nummer</span>
            </th>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                <span class="px-2">Registriert durch</span>
            </th>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                <span class="px-2">Status</span>
            </th>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                <span class="px-2">Follow-up-Termin</span>
            </th>
            <th class="text-uppercase px-2 text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                <span class="px-2"></span>
            </th>
        </tr>
    </thead>
    @if(isset($technicalOffers) && !$technicalOffers->isEmpty())
        <tbody>
            @foreach ($technicalOffers as $item)
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
                    <div class="d-flex px-2 flex-column justify-content-center">
                        <p class="text-dark mb-0">{{ $item->offer_follow_up != '' ? date('d-m-Y',
                                    strtotime($item->offer_follow_up)) : '' }}</p>
                    </div>
                </td>
                <td class="align-middle">

                    <x-anchors.view class="my-2" href="{{ route('technical.view', $item->id) }}"
                        data-original-title="" title=""></x-anchors.view>

                    <x-anchors.edit class="my-2" href="{{ route('technical.edit', $item->id) }}"
                        data-original-title="" title=""></x-anchors.edit>

                    <x-buttons.deleteConfirm.wrapper
                        action="{{ route('technical.destroy', $item->id)  }}">
                        <x-buttons.deleteConfirm.button class="my-2"></x-buttons.deleteConfirm.button>
                    </x-buttons.deleteConfirm.wrapper>
                </td>
            </tr>
            @endforeach
        </tbody>
    @endif
</table>
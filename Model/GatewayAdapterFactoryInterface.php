<?php
/*
 * Copyright © 2022 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\Gateway\Model;

interface GatewayAdapterFactoryInterface
{
    /**
     * Build Gateway Adapter Object
     *
     * @param string $code
     * @param array $arguments [optional] list of parameters which are assumed by creating Object
     *
     * @return GatewayAdapter|null
     */
    public function create(string $code, array $arguments = []): ?GatewayAdapter;
}

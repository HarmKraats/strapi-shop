/*
 *
 * HomePage
 *
 */

import React, { useState } from 'react';
import {
  Layout,
  BaseHeaderLayout,
  ContentLayout,
} from '@strapi/design-system/Layout';

import { TextInput } from '@strapi/design-system';
import { Tooltip } from '@strapi/design-system';
import { Box } from '@strapi/design-system';
// button
import { Button } from '@strapi/design-system';


// functon to save the keys
function saveKeys() {
  // save to database
  // console.log('saveKeys');

  // fetch('http://localhost:1337/stripe-sync', {
  //   method: 'POST',
  //   headers: {
  //     'Content-Type': 'application/json',
  //   },
  //   body: JSON.stringify({
  //     pk: 'pk_test_XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
  //     sk: 'sk_test_XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
  //   }),
  // }) // Copilot generated code
}

  


const HomePage = () => {
  const [Pk, setPk] = useState('');
  const [Sk, setSk] = useState('');




  return (
    <Layout>
      <BaseHeaderLayout
        title="Stripe Sync"
        subtitle="Sync your strapi products with stripe"
        as="h2"
      />
      <ContentLayout>
        <Box>
          <TextInput placeholder="pk_test_XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" label="Publishable key" name="Publishable key" hint="Fill in your Publishable key here"  onChange={e => setPk(e.target.value)} value={Pk} />
        </Box>
        <Box >
          <TextInput placeholder="sk_test_XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" label="Secret key" name="Secret key" hint="Fill in your Secret key here"  onChange={b => setSk(b.target.value)} value={Sk} />
        </Box>
        <Box>
          {/* save button */}
          {/* <Button color="primary" onClick={  }>Save</Button> */}
          
          <Button color="primary" onClick={saveKeys}>Save</Button>

        </Box>
      </ContentLayout>

    </Layout>

  );
};

export default HomePage;
